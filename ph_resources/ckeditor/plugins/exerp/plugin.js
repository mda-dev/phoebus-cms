CKEDITOR.plugins.add( 'exerp',
{
	init: function( editor )
	{
		editor.addCommand( 'insertExerp',
		{
			exec : function( editor )
			{    
				editor.insertHtml( '<hr class="exerp" />');
			}
		});

		editor.ui.addButton( 'Timestamp',
		{
			label: 'Define Exerp Limit',
			command: 'insertExerp',
			icon: this.path + 'images/pagebreak.gif'
		} );

	}


} );