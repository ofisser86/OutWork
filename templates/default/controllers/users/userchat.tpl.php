<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
<link rel="stylesheet" href="../mgVideoChat/mgVideoChat-1.8.0.css">
<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
<div class="container">
    <div class="page-header">
        <h1>Видео чат онлайн консультаций <small>OutWork</small></h1>
        <p>If no one else is in the room, please open the same page in other tab to do self-test.</p>
    </div>
    <div id="mgVideoChat"></div>
</div>

<?php
//echo 'Id second user is '.' '.$user2;
setcookie('mgVideoChatSimple', $userName->nickname, time()+3600, '/');
echo '<input type="hidden" id="room" value="'.$id.'" />';
?>

<!-- Video Chat -->
<script src="../mgVideoChat/mgVideoChat-1.8.0-min.js"></script>
<script src="../mgVideoChat/menu.js"></script>
<script>

    //get query string param
    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }
    //update query strung parameter
    function updateQueryStringParameter(uri, key, value) {
        var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        else {
            return uri + separator + key + "=" + value;
        }
    }
    $(document).ready(function(){
        var room = getParameterByName('room');
        if (!room) {
            var elem = document.getElementById('room');

            var room = elem.value;
            window.location.href = updateQueryStringParameter(window.location.href, 'room', room);
        }
        $('#mgVideoChat').mgVideoChat({
            wsURL: 'ws://' + wsDomain + ':' + wsPort + '?room='+ room
        });
    });
    /*
     $('#mgVideoChat').mgVideoChat({
     wsURL: 'ws://www.inst.loc:8080?room=8'
     });
     */
</script>
