(function() {
    tinymce.PluginManager.add('HS_Shortcodes', function( editor, url ) {

        editor.addButton( 'HS_Shortcodes', {
            title: 'Insert Shortcode',
			type: 'menubutton',
            icon: 'icon hs-own-icon',
			// Menu
			menu: [
					// Slideshow
						   {
                    text: 'Slideshow',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Slideshow Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'num',
                                label: 'How many slides to show?',
								tooltip: 'This is how many slides will be displayed.'
  
                            },{
                                type: 'textbox',
                                name: 'cat',
                                label: 'Which category to pull from?',
								tooltip: 'Enter the slug of the category you would like to pull slides from. Leave blank if you would like to pull from all categories.'
  
                            },{
                                type: 'textbox',
                                name: 'pause',
                                label: 'Pause between slides',
								tooltip: 'Pause between slides in milliseconds. Example: 5000 is a 5 seconds. If you want to disable autoplay function enter: false'
  
                            },{
                                type: 'listbox',
                                name: 'link',
								tooltip: 'Choose yes to open link in a new window.',
                                label: 'Do you want to open link in a new window?',
                                'values': [
                                    {text: 'yes', value: 'true'},
                                    {text: 'no', value: 'false'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'pagin',
								tooltip: 'Enable pagination.',
                                label: 'Pagination',
                                'values': [
                                    {text: 'yes', value: 'true'},
                                    {text: 'no', value: 'false'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'effect',
								tooltip: 'Choose the transition effect.',
                                label: 'Effect',
                                'values': [
                                    {text: 'fade', value: 'fade'},
                                    {text: 'backSlide', value: 'backSlide'},
                                    {text: 'goDown', value: 'goDown'},
									{text: 'fadeUp', value: 'fadeUp'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'clas',
                                label: 'Custom class',
								tooltip: 'Use this field if you want to use a custom class.'
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[slideshow num="' + e.data.num + '" custom_category="' + e.data.cat + '" autoplay="' + e.data.pause + '" blankwindow="' + e.data.link + '" pagination="' + e.data.pagin + '" effect="' + e.data.effect + '" custom_class="' + e.data.clas + '"]');
                            }
                        });
                    }
                },
				// End Slideshow
			// Post grid
						   {
                    text: 'Post grid',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Post grid Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'type',
                                label: 'Type of posts',
								tooltip: 'This is the type of posts. Leave blank for posts from Blog'
  
                            },{
                                type: 'textbox',
                                name: 'cat',
                                label: 'Category',
								tooltip: 'Category name'
  
                            },{
                                type: 'textbox',
                                name: 'num',
                                label: 'Posts per row',
								tooltip: 'Number of posts per row'
  
                            },{
                                type: 'textbox',
                                name: 'rows',
                                label: 'Rows',
								tooltip: 'Number of rows'
  
                            },{
                                type: 'listbox',
                                name: 'orderby',
								tooltip: 'Choose the order by mode.',
                                label: 'Order by',
                                'values': [
                                    {text: 'date', value: 'date'},
                                    {text: 'title', value: 'title'},
									{text: 'popular', value: 'popular'},
									{text: 'random', value: 'random'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'order',
								tooltip: 'Choose the order mode ( from Z to A or from A to Z).',
                                label: 'Order',
                                'values': [
                                    {text: 'DESC', value: 'DESC'},
                                    {text: 'ASC', value: 'ASC'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'meta',
								tooltip: 'Show a post meta?',
                                label: 'Meta',
                                'values': [
                                    {text: 'yes', value: 'yes'},
                                    {text: 'no', value: 'no'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'date',
								tooltip: 'Show post date?',
                                label: 'Date',
                                'values': [
                                    {text: 'yes', value: 'yes'},
                                    {text: 'no', value: 'no'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'excerpt',
                                label: 'The number of characters in the excerpt',
								tooltip: 'How many characters are displayed in the excerpt?'
  
                            },{
                                type: 'listbox',
                                name: 'link',
								tooltip: 'Show link after posts, yes or no.',
                                label: 'Link',
                                'values': [
                                    {text: 'yes', value: 'yes'},
                                    {text: 'no', value: 'no'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'linktxt',
                                label: 'Link Text',
								tooltip: 'Text for the link.'
  
                            },{
                                type: 'textbox',
                                name: 'classc',
                                label: 'Custom class',
								tooltip: 'Use this field if you want to use a custom class for posts.'
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[posts_grid type="' + e.data.type + '" category="' + e.data.cat + '" columns="' + e.data.num + '" rows="' + e.data.rows + '" order_by="' + e.data.orderby + '" order="' + e.data.order + '" meta="' + e.data.meta + '" isdate="' + e.data.date + '" excerpt_count="' + e.data.excerpt + '" link="' + e.data.link + '" link_text="' + e.data.linktxt + '" custom_class="' + e.data.classc + '"]');
                            }
                        });
                    }
                },
				// End Post grid
			// Elements
			{
                    text: 'Elements',
            menu: [
            	{
            		text: 'Text highlight', value: '[highlight][/highlight]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'Blockquote', value: '[blockquote][/blockquote]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'Spacer', value: '[spacer]', onclick: function() {editor.insertContent(this.value()); }
           		},	
				// Skills
		   {
                    text: 'Skills',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Skills Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'val',
                                label: 'Value',
								tooltip: 'Enter the value for circle (%).'
                            },
                            {
                                type: 'textbox',
                                name: 'size',
                                label: 'Size',
								tooltip: 'Enter the size of the circle. Default is 180'
                            },
                            {
                                type: 'textbox',
                                name: 'bg',
                                label: 'Background Color',
								tooltip: 'Enter the Background Color. Default is #f2f2f2'
  
                            },
							{
                                type: 'textbox',
                                name: 'fg',
                                label: 'Foreground Color',
								tooltip: 'Enter the Foreground Color. Default is #000000'
  
                            },{
                                type: 'textbox',
                                name: 'thick',
                                label: 'Thickness',
								tooltip: 'Enter the thickness of the wheel. Default is 27.'
  
                            },{
                                type: 'textbox',
                                name: 'title',
                                label: 'Title',
								tooltip: 'Enter the title.'
  
                            },{
                                type: 'textbox',
                                name: 'fm',
                                label: 'Font Family',
								tooltip: 'Enter the Font Family.'
  
                            },{
                                type: 'textbox',
                                name: 'fsize',
                                label: 'Font Size',
								tooltip: 'Enter Font Size.'
  
                            },{
                                type: 'textbox',
                                name: 'fstyle',
                                label: 'Font Style',
								tooltip: 'Enter Font Style.'
  
                            },{
                                type: 'textbox',
                                name: 'cclass',
                                label: 'Custom class',
								tooltip: 'Use this field if you want to use a custom class.'
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[skills value="' + e.data.val + '" size="' + e.data.size + '"' + ' bgcolor="' + e.data.bg + '" fgcolor="' + e.data.fg + '" donutwidth="' + e.data.thick + '" title="' + e.data.title + '" font="' + e.data.fm + '" fontsize="' + e.data.fsize + '" fontstyle="' + e.data.fstyle + '" custom_class="' + e.data.cclass + '"][/skills]');
                            }
                        });
                    }
                },
				// End Skills
				// Progressbar
						   {
                    text: 'Progressbar',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Progressbar Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'val',
                                label: 'Value',
								tooltip: 'Enter the value for bar (%).'
                            },
                            {
                                type: 'textbox',
                                name: 'label',
                                label: 'Label',
								tooltip: 'Enter label.'
                            },{
                                type: 'textbox',
                                name: 'cclass',
                                label: 'Custom class',
								tooltip: 'Use this field if you want to use a custom class.'
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[progressbar value="' + e.data.val + '" label="' + e.data.label + '"' + ' custom_class="' + e.data.cclass + '"]');
                            }
                        });
                    }
                },
				// End Progressbar
				// Drop Cap
						   {
                    text: 'Drop Cap',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Drop Cap Shortcode',
                            body: [{
                                type: 'listbox',
                                name: 'cclass',
								tooltip: 'Choose CSS class.',
                                label: 'Css Class',
                                'values': [
                                    {text: 'normal', value: 'normal'},
                                    {text: 'black', value: 'bl'},
                                    {text: 'white', value: 'wh'}
                                ]
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[dropcap custom_class="' + e.data.cclass + '"] ... [/dropcap]');
                            }
                        });
                    }
                },
				// End Drop Cap
				// Button
						   {
                    text: 'Button',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Button Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'btxt',
                                label: 'Button Text',
								tooltip: 'Enter the text for button.'
  
                            },{
                                type: 'textbox',
                                name: 'iconame',
                                label: 'Icon name',
								tooltip: 'Enter the name of the icon. Example: icon-shopping-cart. Complete list of the icons you will find in Documentation/Icons/demo.html file.'
  
                            },{
                                type: 'textbox',
                                name: 'btlink',
                                label: 'Button Link',
								tooltip: 'Enter the link for button. (e.g. http://demolink.org)'
  
                            },{
                                type: 'listbox',
                                name: 'style',
								tooltip: 'Choose button style.',
                                label: 'Style',
                                'values': [
                                    {text: 'primary', value: 'primary'},
                                    {text: 'color', value: 'color'},
                                    {text: 'white', value: 'white'},
									{text: 'link', value: 'link'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'size',
								tooltip: 'Choose button size.',
                                label: 'Size',
                                'values': [
                                    {text: 'mini', value: 'mini'},
                                    {text: 'small', value: 'small'},
                                    {text: 'normal', value: 'normal'},
									{text: 'large', value: 'large'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'target',
								tooltip: 'The target attribute specifies a window or a frame where the linked document is loaded.',
                                label: 'Target',
                                'values': [
                                    {text: '_blank', value: '_blank'},
                                    {text: '_self', value: '_self'},
                                    {text: '_parent', value: '_parent'},
									{text: '_top', value: '_top'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'display',
								tooltip: 'Choose between inline and block display options.',
                                label: 'Display',
                                'values': [
                                    {text: 'inline', value: 'inline'},
                                    {text: 'block', value: 'block'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'class',
                                label: 'Class',
								tooltip: 'Any CSS classes you want to add'
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[button text="' + e.data.btxt + '" link="' + e.data.btlink + '" style="' + e.data.style + '" size="' + e.data.size + '" target="' + e.data.target + '" display="' + e.data.display + '" class="' + e.data.class + '" icon="' + e.data.iconame + '"]');
                            }
                        });
                    }
                },
				// End Button
								// Icon
						   {
                    text: 'Icon',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Iocn Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'iconame',
                                label: 'Icon name',
								tooltip: 'Enter the name of the icon. Example: icon-shopping-cart. Complete list of the icons you will find in Documentation/Icons/demo.html file.'
  
                            },{
                                type: 'listbox',
                                name: 'align',
								tooltip: 'Choose icons align.',
                                label: 'Align',
                                'values': [
                                    {text: 'left', value: 'left'},
                                    {text: 'right', value: 'right'},
                                    {text: 'center', value: 'center'},
									{text: 'none', value: 'none'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'size',
								tooltip: 'Choose icons size.',
                                label: 'Size',
                                'values': [
                                    {text: 'icon-1x', value: 'icon-1x'},
                                    {text: 'icon-2x', value: 'icon-2x'},
                                    {text: 'icon-3x', value: 'icon-3x'},
									{text: 'icon-4x', value: 'icon-4x'},
									{text: 'icon-5x', value: 'icon-5x'},
									{text: 'icon-6x', value: 'icon-6x'},
									{text: 'icon-7x', value: 'icon-7x'},
									{text: 'icon-8x', value: 'icon-8x'},
									{text: 'icon-9x', value: 'icon-9x'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'icocolor',
                                label: 'Icon color',
								tooltip: 'Enter icons color'
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[icon icons="' + e.data.iconame + '" align="' + e.data.align + '" size="' + e.data.size + '" color="' + e.data.icocolor + '"]');
                            }
                        });
                    }
                },
				// End Icon
           ]
		   },
		   // End Elements
			// Lists
			{
                    text: 'Lists',
            menu: [
            	{
            		text: 'Unstyled', value: '[list_un][/list_un]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'Check List 1', value: '[check_list][/check_list]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'Check List 2', value: '[check2_list][/check2_list]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'Arrow list 1', value: '[arrow_list][/arrow_list]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'Arrow list 2', value: '[arrow2_list][/arrow2_list]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'Circle List', value: '[circle_list][/circle_list]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'Plus List', value: '[plus_list][/plus_list]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'Minus List', value: '[minus_list][/minus_list]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'Custom List', value: '[custom_list][/custom_list]', onclick: function() {editor.insertContent(this.value()); }
           		}
           ]
		   },
		   // End Lists
		   			// Start Columns
			{
                    text: 'Columns',
            menu: [
            	{
            		text: 'row fluid', value: '[row_fluid custom_class=""][/row_fluid]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'row', value: '[row custom_class=""][/row]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'container', value: '[container custom_class=""][/container]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'widerow', value: '[widerow customclass=""][/widerow]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'span1', value: '[span1][/span1]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'span2', value: '[span2][/span2]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'span3', value: '[span3][/span3]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'span4', value: '[span4][/span4]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'span5', value: '[span5][/span5]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'span6', value: '[span6][/span6]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'span7', value: '[span7][/span7]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'span8', value: '[span8][/span8]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'span9', value: '[span9][/span9]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'span10', value: '[span10][/span10]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'span11', value: '[span11][/span11]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: 'span12', value: '[span12][/span12]', onclick: function() {editor.insertContent(this.value()); }
           		}
           ]
		   },
		   // End Columns
		   // Start Fluid Columns
			{
                    text: 'Fluid Columns',
            menu: [
            	{
            		text: '1/2 - 1/2', value: '[row_fluid][one_half] ... [/one_half][one_half] ... [/one_half][/row_fluid]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: '1/3 - 1/3 - 1/3', value: '[row_fluid][one_third] ... [/one_third][one_third] ... [/one_third][one_third] ... [/one_third][/row_fluid]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: '1/3 - 2/3', value: '[row_fluid][one_third] ... [/one_third][two_third] ... [/two_third][/row_fluid]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: '1/4 - 1/4 - 1/4 - 1/4', value: '[row_fluid][one_fourth] ... [/one_fourth][one_fourth] ... [/one_fourth][one_fourth] ... [/one_fourth][one_fourth] ... [/one_fourth][/row_fluid]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: '1/4 - 3/4', value: '[row_fluid][one_fourth] ... [/one_fourth][three_fourth] ... [/three_fourth][/row_fluid]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: '1/6 - 1/6 - 1/6 - 1/6 - 1/6 - 1/6', value: '[row_fluid][one_sixth] ... [/one_sixth][one_sixth] ... [/one_sixth][one_sixth] ... [/one_sixth][one_sixth] ... [/one_sixth][one_sixth] ... [/one_sixth][one_sixth] ... [/one_sixth][/row_fluid]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: '1/6 - 5/6', value: '[row_fluid][one_sixth] ... [/one_sixth][five_sixth] ... [/five_sixth][/row_fluid]', onclick: function() {editor.insertContent(this.value()); }
           		}
           ]
		   },
		   // End Fluid Columns
			// Start 2 Columns
			{
                    text: '2 Columns',
            menu: [
            	{
            		text: '50% | 50%', value: '[span6][/span6][span6][/span6]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: '75% | 25%', value: '[span8][/span8][span4][/span4]', onclick: function() {editor.insertContent(this.value()); }
           		},
				{
            		text: '25% | 25%', value: '[span4][/span4][span8][/span8]', onclick: function() {editor.insertContent(this.value()); }
           		}
           ]
		   },
		   // End 2 Columns
		   // Start 3 Columns
		   {
                    text: '3 Columns',
            menu: [
            	{
            		text: '33.3% | 33.3% | 33.3%', value: '[span4][/span4][span4][/span4][span4][/span4]', onclick: function() { editor.insertContent(this.value()); }
           		},
				{
            		text: '50% | 25% | 25%', value: '[span6][/span6][span3][/span3][span3][/span3]', onclick: function() { editor.insertContent(this.value()); }
           		},
				{
            		text: '25% | 50% | 25%', value: '[span3][/span3][span6][/span6][span3][/span3]', onclick: function() { editor.insertContent(this.value()); }
           		},
				{
            		text: '25% | 25% | 50%', value: '[span3][/span3][span3][/span3][span6][/span6]', onclick: function() { editor.insertContent(this.value()); }
           		}
           ]
		   },
		   // End 3 Columns
		   	   // Start 4 Columns
		   {
                    text: '4 Columns',
            menu: [
            	{
            		text: '25% | 25% | 25% | 25%', value: '[span3][/span3][span3][/span3][span3][/span3][span3][/span3]', onclick: function() { editor.insertContent(this.value()); }
           		}
           ]
		   },
		   // End 4 Columns
		   // Video
		   {
                    text: 'Video',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Video Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'fileURL',
                                label: 'File URL',
								tooltip: 'Enter the url to the video file. YouTube example: http://youtube.com/watch?v=3H8bnKdf654. Vimeo example: http://vimeo.com/9679622'
                            },
                            {
                                type: 'textbox',
                                name: 'width',
                                label: 'Enter the width of your video'
                            },
                            {
                                type: 'textbox',
                                name: 'height',
                                label: 'Enter the height of your video',
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[videos file="' + e.data.fileURL + '" width="' + e.data.width + '" height="' + e.data.height + '"][/videos]');
                            }
                        });
                    }
                },
				// End Video
				// heading_entrance
		   {
                    text: 'Heading entrance',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert heading entrance Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'title',
                                label: 'Enter title'
                            },
                            {
                                type: 'textbox',
								multiline: true,
								minHeight: 150,
                                name: 'text',
                                label: 'Enter text'
                            },
                            {
                                type: 'textbox',
                                name: 'custom_class',
                                label: 'Use this field if you want to use a custom class',
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[heading_entrance title="' + e.data.title + '" text="' + e.data.text + '" custom_class="' + e.data.custom_class + '"][/heading_entrance]');
                            }
                        });
                    }
                },
				// End heading_entrance
								// Parallax
		   {
                    text: 'Parallax',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Parallax Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'image',
                                label: 'Image',
								tooltip: 'Enter the image URL'
                            },{
                                type: 'textbox',
                                name: 'voff',
                                label: 'Vertical offset',
								tooltip: 'Enter the vertical offset value'
                            },{
                                type: 'textbox',
                                name: 'title',
                                label: 'Title',
								tooltip: 'Enter title.'
                            },
                            {
                                type: 'textbox',
								multiline: true,
								minHeight: 180,
                                name: 'text',
                                label: 'Enter text'
                            },
                            {
                                type: 'textbox',
                                name: 'margin',
                                label: 'Top and bottom text margin',
								tooltip: 'Enter the top and bottom margin value (Do not enter the px unit.)'
  
                            },{
                                type: 'textbox',
                                name: 'ovcolor',
                                label: 'Overlay color',
								tooltip: 'Enter the overlay color'
                            },{
                                type: 'textbox',
                                name: 'ovopa',
                                label: 'Overlay opacity',
								tooltip: 'Enter the Overlay opacity value'
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[parallax photourl="' + e.data.image + '" verticaloffset="' + e.data.voff + '" title="' + e.data.title + '" text="' + e.data.text + '" textmargin="' + e.data.margin + '" overlaycolor="' + e.data.ovcolor + '" overlayopacity="' + e.data.ovopa + '"][/parallax]');
                            }
                        });
                    }
                },
				// End Parallax
				// Full width image
		   {
                    text: 'Full width image',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Full width image Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'image',
                                label: 'Image',
								tooltip: 'Enter the image URL'
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[fullwidthimage photourl="' + e.data.image + '"]');
                            }
                        });
                    }
                },
				// End Full width image
				// Google Map
		   {
                    text: 'Google Map',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Google Map Shortcode',
                            body: [{
                                type: 'textbox',
                                name: 'lat',
                                label: 'Latitude',
								tooltip: 'Set latitude for your map.'
                            },
                            {
                                type: 'textbox',
                                name: 'lon',
                                label: 'Longitude',
								tooltip: 'Set longitude for your map.'
                            },
                            {
                                type: 'textbox',
                                name: 'height',
                                label: 'Height',
								tooltip: 'Enter height of your map.'
  
                            },
							{
                                type: 'textbox',
                                name: 'zoom',
                                label: 'Zoom',
								tooltip: 'Set zoom for your map'
  
                            },{
                                type: 'textbox',
                                name: 'sat',
                                label: 'Saturation',
								tooltip: 'Set saturation of your map.'
  
                            },{
                                type: 'textbox',
                                name: 'hue',
                                label: 'Hue',
								tooltip: 'Set hue of your map. (Example: #28a0ff)'
  
                            },{
                                type: 'textbox',
                                name: 'title',
                                label: 'Title',
								tooltip: 'Set marker title.'
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[map latitude="' + e.data.lat + '" longitude="' + e.data.lon + '" height="' + e.data.height + '" zoom="' + e.data.zoom + '" saturation="' + e.data.sat + '" hue="' + e.data.hue + '" title="' + e.data.title + '"][/map]');
                            }
                        });
                    }
                },
				// End Google Map
				// Table
				{
            		text: 'Table', value: '[table td1="#" td2="Title" td3="Value"] [td1] 1 [/td1] [td2] some title 1 [/td2] [td3] some value 1 [/td3] [/table]', onclick: function() { editor.insertContent(this.value()); }
           		},
				// End Table
				// Accordion
				{
            		text: 'Accordion', value: '[accordions] [accordion title="title1" visible="yes"] tab content [/accordion] [accordion title="title2"] another content tab [/accordion] [/accordions]', onclick: function() { editor.insertContent(this.value()); }
           		},
				// End Accordion
				// Tabs
				{
            		text: 'Tabs', value: '[tabs tab1="Title #1" tab2="Title #2" tab3="Title #3"] [tab1] Tab 1 content... [/tab1] [tab2] Tab 2 content... [/tab2] [tab3] Tab 3 content... [/tab3] [/tabs]', onclick: function() { editor.insertContent(this.value()); }
           		},
				// End Tabs
				// Alert box
						   {
                    text: 'Alert box',
                    onclick: function() {
                        editor.windowManager.open( {
                            title: 'Insert Alert box Shortcode',
                            body: [{
                                type: 'listbox',
                                name: 'style',
								tooltip: 'Alert Box style.',
                                label: 'Style',
                                'values': [
                                    {text: 'message', value: 'message'},
                                    {text: 'info', value: 'info'},
									{text: 'success', value: 'success'},
									{text: 'danger', value: 'danger'}
                                ]
                            },{
                                type: 'listbox',
                                name: 'clbut',
								tooltip: 'Show close button or not - yes, no.',
                                label: 'Close button',
                                'values': [
                                    {text: 'yes', value: 'yes'},
                                    {text: 'no', value: 'no'}
                                ]
                            },{
                                type: 'textbox',
                                name: 'clas',
                                label: 'Custom class',
								tooltip: 'Use this field if you want to use a custom class.'
  
                            }],
                            onsubmit: function( e ) {
                                editor.insertContent( '[alert_box style="' + e.data.style + '" close="' + e.data.clbut + '" custom_class="' + e.data.clas + '"]Hello, World![/alert_box]');
                            }
                        });
                    }
                },
				// End Alert box
		   ] 
//End
        });
    });
})();
