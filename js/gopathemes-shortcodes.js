(function () {
    tinymce.PluginManager.add('gopathemes_shortcode_button', function (editor, url) {
        editor.addButton('gopathemes_shortcode_button', {
            text: 'Shortcodes',
            icon: false,
            type: 'menubutton',
            menu: [
                {
                    text: 'Button',
                    onclick: function () {
                        editor.windowManager.open({
                            title: 'Insert Button Shortcode',
                            body: [
                                {
                                    type: 'listbox',
                                    name: 'type',
                                    label: 'Type',
                                    'values': [
                                        {text: 'Link', value: 'link'},
                                        {text: 'Button', value: 'button'}
                                    ]
                                },
                                
                                {
                                    type: 'listbox',
                                    name: 'class',
                                    label: 'Class',
                                    'values': [
                                        {text: 'Primary', value: 'btn-primary'},
                                        {text: 'Success', value: 'btn-success'},
                                        {text: 'Info', value: 'btn-info'},
                                        {text: 'Warning', value: 'btn-warning'},
                                        {text: 'Danger', value: 'btn-danger'},
                                        {text: 'Link', value: 'btn-link'}
                                    ]
                                },
                                
                                {
                                    type: 'listbox',
                                    name: 'style',
                                    label: 'Style',
                                    'values': [
                                        {text: 'Flat', value: ''},
                                        {text: '3D', value: 'btn-threed'},
                                        {text: 'Transparent', value: 'btn-transparent'}
                                    ]
                                },
                                
                                {
                                    type: 'listbox',
                                    name: 'border',
                                    label: 'Border',
                                    'values': [
                                        {text: 'No Radius', value: ''},
                                        {text: 'Rounded', value: 'btn-rounded'},
                                        {text: 'Circle', value: 'btn-circle'}
                                    ]
                                },
                                
                                {
                                    type: 'listbox',
                                    name: 'size',
                                    label: 'Size',
                                    'values': [
                                        {text: 'Default', value: ''},
                                        {text: 'Large', value: 'btn-lg'},
                                        {text: 'Small', value: 'btn-sm'},
                                        {text: 'Extra Small', value: 'btn-xs'}
                                    ]
                                },
                                
                                {
                                    type   : 'checkbox',
                                    name   : 'make_block',
                                    label  : 'Make Block level?',
                                    text   : 'Yes',
                                    value   : 'yes',
                                    checked : false
                                },
                                
                                {
                                    type: 'textbox',
                                    name: 'text',
                                    label: 'Text',
                                    value: 'Button'
                                },
                                
                                {
                                    type: 'textbox',
                                    name: 'link',
                                    label: 'Link to',
                                    value: 'http://'
                                },
                                
                                {
                                    type: 'textbox',
                                    name: 'rel',
                                    label: 'Rel',
                                    value: ''
                                },
                                
                                {
                                    type: 'textbox',
                                    name: 'extra_class',
                                    label: 'Extra class name',
                                    value: ''
                                },
                                
                                {
                                    type   : 'checkbox',
                                    name   : 'new_window',
                                    label  : 'Open in new window?',
                                    text   : 'Yes',
                                    value   : 'yes',
                                    checked : false
                                }
                                
                            ],
                            onsubmit: function (e) {
                                
                                var content = '[gt_button';
                                    content += ' type="' + e.data.type + '"';
                                    content += ' class="' + e.data.class + '"';
                                    content += ( e.data.size !== '' )           ? ' size="' + e.data.size + '"' : '';
                                    content += ( e.data.style !== '' )           ? ' style="' + e.data.style + '"' : '';
                                    content += ( e.data.border !== '' )           ? ' border="' + e.data.border + '"' : '';
                                    content += ( e.data.make_block === true )   ? ' make_block="'+ e.data.make_block +'"' : '';
                                    content += ' link="'+ e.data.link +'"';
                                    content += ( e.data.rel !== '' )            ? ' rel="'+ e.data.rel +'"' : '';
                                    content += ( e.data.extra_class !== '' )            ? ' extra_class="'+ e.data.extra_class +'"' : '';
                                    content += ( e.data.new_window === true )   ? ' new_window="'+ e.data.new_window +'"' : '';
                                    content += ']';
                                    content += e.data.text;
                                    content += '[/gt_button]';
                                
                                editor.insertContent(content);
                                
                            }
                        });
                    }

                }
            ]
        });
    });
})();