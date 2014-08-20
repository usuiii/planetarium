<?php $this->Wamp->init(); ?>
<script type="text/javascript">
function send(){
  cakeWamp.publish('Plugin.TopicName', {
        type: 'eventObject',
        text:$('#text').val()
    });
}
function sendPlanet(){
  cakeWamp.publish('Planetarium', {
        type: 'eventObject',
        text:$('#text').val()
    });
}
</script>
<input type="text" id="text" />
<input type="button" id="button" value="Send" onclick="send();" />
<input type="button" id="button" value="planetarium" onclick="sendPlanet();" />

