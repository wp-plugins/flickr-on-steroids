/* TinyMCE plugin for Flickr in your Blog plug-in.
   Details on creating TinyMCE plugins at
     http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x 
*/
(function() {

tinymce.create('tinymce.plugins.fib_plugin', {
	getInfo : function() {
		return {
			longname : 'FiB Support for Editor',
			author : 'Alexey Smirnov',
			authorurl : 'http://alexeysmirnov.name/',
			infourl : 'http://alexeysmirnov.name/',
			version : "0.1"
		};
	},

	init : function(ed, url) {
		ed.addButton('fib_button', {
			title : 'fib_plugin.insertbutton',
			image : '../wp-content/plugins/flickr-on-steroids/img/flickr.png',
			onclick : function () {
				edInsertMyImage_gui();
			}
		});
	},

	createControl : function (n, cm) {
		return null;
	}

});

// Adds the plugin class to the list of available TinyMCE plugins
tinymce.PluginManager.add('fib_plugin', tinymce.plugins.fib_plugin);
})();
