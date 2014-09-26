#
# Cookbook Name:: default
# Recipe:: default
#
# Copyright 2014, usuiii
#
# All rights reserved - Do Not Redistribute
#

# update yum
execute "yum-update" do
  user "root"
  command "yum -y update"
  action :run
end

packages = %w{mysql php-pecl-event php php-mcrypt php-mbstring php-mysql php-cli php-fpm php-pear nginx curl php-gd supervisor haproxy libevent-devel git php-devel mlocate}
packages.each do |pkg|
    package pkg do
      action [:install, :upgrade]
      options "--enablerepo=epel,remi"
    end
end

# add phpUnit
execute "phpunit-install" do
  command "pear config-set auto_discover 1; pear install pear.phpunit.de/PHPUnit-3.7.32"
  not_if { ::File.exists?("/usr/bin/phpunit")}
end

# add composer
execute "composer-install" do
  command "curl -sS https://getcomposer.org/installer | php ;mv composer.phar /usr/local/bin/composer"
  not_if { ::File.exists?("/usr/local/bin/composer")}
end

execute "composer-install" do
  user "root"
  command "cd /var/www/planetarium/data; composer install"
  not_if { ::File.exists?("/var/www/planetarium/data/composer.lock")}
end

execute "composer-update" do
  user "root"
  command "cd /var/www/planetarium/data; composer update"
  action  :run
end

template "/etc/nginx/nginx.conf" do
  user "root"
  mode 0644
  source "nginx.conf.erb"
end

template "/etc/nginx/conf.d/default.conf" do
  mode 0644
  source "php-fpm.conf.erb"
end

%w{httpd iptables}.each do |service_name|
  service service_name do
    action [ :disable, :stop ]
  end
end

%w{php-fpm nginx}.each do |service_name|
    service service_name do
      action [ :enable, :start, :restart ]
    end
end

#haproxy.cfg
template "/etc/haproxy/haproxy.cfg" do
  user "root"
  mode 0644
  source "haproxy.cfg.erb"
end
service "haproxy" do
  action   [ :enable, :start , :restart]
end  


#supervisord.cfg
template "/etc/supervisord.conf" do
  user "root"
  mode 0644
  source "supervisord.conf.erb"
end
service "supervisord" do
  action   [ :enable, :start , :restart]
end  

# set php.ini date.timezone
template "/etc/php.d/timezone.ini" do
  mode 0644
  source "timezone.ini.erb"
end

# set server-localtime
link "/etc/localtime" do
  to "/usr/share/zoneinfo/#{node['timezone']}"
  notifies :restart, "service[nginx]", :delayed
  notifies :restart, "service[php-fpm]", :delayed
  not_if "readlink /etc/localtime | grep -q '#{node['timezone']}$'"
end

# init mysql
# execute "mysql-install-db" do
#  user "root"
#  command "mysql_install_db"
#  action  :run
#  not_if  { File.exists?('/var/lib/mysql/mysql/user.frm') }
# end

# service "mysqld" do
#  action   [ :enable, :start ]
# end  

# execute "mysql-init" do
#  user "root"
#  command <<EOS
#    mysql -u root --execute  "create database if not exists planetarium CHARACTER SET utf8;"
#    mysql -u root --execute  "create database if not exists planetarium_test CHARACTER SET utf8;"
#    cd /vagrant_data/app; ./Console/cake Migrations.migration run all
# EOS
# action :run
# end


