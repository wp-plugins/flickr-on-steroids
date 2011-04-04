<?php
    global $myimage_plugin_url;
?>

<script type="text/javascript">//<![CDATA[

  var is_from_gui;
  var popup;

  function edInsertMyImage_gui() {
    popup = new AIS.Popup("Build a gallery", 1000, "<iframe src='" + "<?php echo $myimage_plugin_url; ?>/lightbox.php?TB_iframe=true' width=1000 height=530></iframe>");
    popup.show();
    is_from_gui = true;
  }

  function edInsertMyImage() {
    popup = new AIS.Popup("Build a gallery", 1000, "<iframe src='" + "<?php echo $myimage_plugin_url; ?>/lightbox.php?TB_iframe=true' width=1000 height=530></iframe>");
    popup.show();

    is_from_gui=false;
  }

  function edInsertMyImageDone(r) {
    popup.hide();

    if (r.numimg==0)
      return;

    var txt = "<scr"+"ipt>"+
"new AIS.ImageGallery('"+r.name+"', "+4+"," + ((r.img_size == "m500") ? 520:660)  +",[";

    var i;

    for (i=0; i<r.numimg; i++)  {
      if (i!=0) 
        txt = txt+',';
      txt = txt+"'" + r.titles[i]+"'";
    }
    txt = txt+"],[";

    for (i=0; i<r.numimg; i++)  {
      if (i!=0) 
        txt = txt+',';
      txt = txt+"'" + r.thumbs[i]+"'";
    }
    txt = txt+"],[";

    for (i=0; i<r.numimg; i++)  {
      if (i!=0) 
        txt = txt+',';
      txt = txt+"'" + ((r.img_size == "m500") ? r.normals[i] : r.normals640[i]) +"'";
    }
    txt = txt+"],[";

    for (i=0; i<r.numimg; i++)  {
      if (i!=0) 
        txt = txt+',';
      txt = txt+"'" + r.imgs[i]+"'";
    }
    txt = txt+"]);</scr"+"ipt>";

    if (is_from_gui)
    {
	tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, txt);
	tinyMCE.execCommand('mceCleanup');
    } else
    {
      edInsertContent(edCanvas, txt);
    }
  }

  if (myimage_qttoolbar = document.getElementById("ed_toolbar")){
    newbutton = document.createElement("input");
    newbutton.type = "button";
    newbutton.id = "ed_fib";
    newbutton.className = "ed_button";
    newbutton.value = "Flickr";
    newbutton.onclick = edInsertMyImage;
    myimage_qttoolbar.appendChild(newbutton);
  }

//]]></script>

