<?php $this->Wamp->init(); ?>
<?php $this->Html->scriptStart(array('inline' => false)); ?>
$(document).ready(function(){
    $('#send_button').click(function(){
        cakeWamp.publish('Plugin.TopicName', {
            type: 'eventObject',
            text:$('#message_text').val()
        });
    });

    $('.start_button').click(function(){
        //星データ取得
        $.ajax({
          type: 'GET',
          url: '/stars/1.json?no=' + $(this).data('no'),
          dataType: 'json',
          success: function(json){
              cakeWamp.publish('Planetarium', {
                type: 'starData',
                stars: json.stars
              });    
          }
        });

        
    });
});
<?php $this->Html->scriptEnd(); ?>

<?php echo $this->Form->create(); ?>
<?php echo $this->Form->input('message', array('id' => 'message_text')); ?>
<?php echo $this->Form->end(array('label' => 'send', 'type' => 'button', 'id' => 'send_button')); ?>
<?php echo $this->Form->create(); ?>
<?php echo $this->Form->end(array('label' => 'planetarium1', 'type' => 'button', 'class' => 'start_button', 'data-no' => 1)); ?>
<?php echo $this->Form->end(array('label' => 'planetarium2', 'type' => 'button', 'class' => 'start_button', 'data-no' => 300)); ?>
