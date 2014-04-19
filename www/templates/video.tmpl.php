<!-- START OF THE PLAYER EMBEDDING TO COPY-PASTE -->
<div id="mediaplayer_<?=$id?>">JW Player goes here</div>


<script type="text/javascript">				
    jwplayer("mediaplayer_<?=$id?>").setup({					
        file: "<?=$link?>",
        width: "240",
        height: "180",        
        modes: [{
            type: 'flash',
            src: "/_js/jwplayer/player.swf",
            config: {skin: "/_js/jwplayer/newtubedark.zip"}
        },
        {
            type: 'html5',
            config: {skin: "/_js/jwplayer/newtubedark.xml"}
        }]
    });                            
</script>
<!-- END OF THE PLAYER EMBEDDING -->    