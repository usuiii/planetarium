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
<p>planetarium</p>
<table>
  <tr>
    <td><?php echo $this->Form->end(array('label' => '1', 'type' => 'button', 'class' => 'start_button', 'data-no' => 1)); ?></td>
    <td><?php echo $this->Form->end(array('label' => '2', 'type' => 'button', 'class' => 'start_button', 'data-no' => 2)); ?></td>
    <td><?php echo $this->Form->end(array('label' => '3', 'type' => 'button', 'class' => 'start_button', 'data-no' => 3)); ?></td>
    <td><?php echo $this->Form->end(array('label' => '4', 'type' => 'button', 'class' => 'start_button', 'data-no' => 4)); ?></td>
    <td><?php echo $this->Form->end(array('label' => '5', 'type' => 'button', 'class' => 'start_button', 'data-no' => 5)); ?></td>
  </tr>
  <tr>
    <td><?php echo $this->Form->end(array('label' => '6', 'type' => 'button', 'class' => 'start_button', 'data-no' => 6)); ?></td>
    <td><?php echo $this->Form->end(array('label' => '7', 'type' => 'button', 'class' => 'start_button', 'data-no' => 7)); ?></td>
    <td><?php echo $this->Form->end(array('label' => '8', 'type' => 'button', 'class' => 'start_button', 'data-no' => 8)); ?></td>
    <td><?php echo $this->Form->end(array('label' => '9', 'type' => 'button', 'class' => 'start_button', 'data-no' => 9)); ?></td>
    <td><?php echo $this->Form->end(array('label' => '10', 'type' => 'button', 'class' => 'start_button', 'data-no' => 10)); ?></td>
  </tr>
  <tr>
    <td><?php echo $this->Form->end(array('label' => '11', 'type' => 'button', 'class' => 'start_button', 'data-no' => 11)); ?></td>
    <td><?php echo $this->Form->end(array('label' => '12', 'type' => 'button', 'class' => 'start_button', 'data-no' => 12)); ?></td>
    <td><?php echo $this->Form->end(array('label' => '13', 'type' => 'button', 'class' => 'start_button', 'data-no' => 13)); ?></td>
    <td><?php echo $this->Form->end(array('label' => '14', 'type' => 'button', 'class' => 'start_button', 'data-no' => 14)); ?></td>
    <td><?php echo $this->Form->end(array('label' => '15', 'type' => 'button', 'class' => 'start_button', 'data-no' => 15)); ?></td>
  </tr>
</table>
  