CKEDITOR.plugins.add( 'loremipsum',
{
	init: function( editor )
	{
		editor.addCommand( 'insertLoremIpsum',
		{
			exec : function( editor )
			{  

			var paragraphs = [
"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean quis lorem turpis, id suada male eros. Pellentesque tortor neque, id ultrices posuere vel, at semper neque. Donec facilisis orci bibendum ante consectetur feugiat. Quisque dignissim tristique vestibulum. Justo ut est, sed dictum tristique nec, rhoncus et tortor. Elit nulla consequat nec mauris commodo lobortis. Aliquam et tristique dolor. Curabitur ut male suada arcu. Nulla tincidunt laoreet libero, et consequat scelerisque erat varius. Etiam arcu this, dapibus ut ut aliquet, blandit non ante. Cursus aliquam consequat mauris pulvinar cursus. Aenean vel justo eros, posuere vitae dolor sit amet.",

"Ut luctus vulputate vel venenatis NISL. In diam in cursus. Nam feugiat magna ac orci ultricies viverra. Mauris ultricies orci orci. Morbi in quis justo magna blandit fermentum. Etiam tincidunt faucibus viverra. Sed risus ipsum, in aliquam mattis id, dapibus a enim. Ut erat mi, imperdiet a tincidunt in, eleifend NISL sed. Duis leo nisi feugiat in viverra ut sapien temporary pretium. Phasellus magna NISL, male suada pharetra consequat eu, fringilla vel metus. Nam in neque ut nunc dapibus dictum. Etiam ut ligula et purus consequat tincidunt. Nulla aliquet velit non diam molestie posuere. Nulla nisi vulputate neque, et porta blandit, vulputate in lacus. Vivamus justo dui, molestie eget eleifend a, feugiat luctus leo.",

"Nunc mauris sed massa. Proin varius euismod feugiat. Ut quis sit amet ante sapien elementum lobortis. Morbi posuere aliquet this iaculis iaculis. Sed aliquet vestibulum porta. Vivamus in purus nec nunc euismod rhoncus. Cras hendrerit pulvinar euismod. Aenean ut quam a risus semper semper. Mauris molestie tristique lectus aliquet ac. Suspendisse ultricies lorem libero sagittis tempus et erat volutpat elementum. Maecenas sed odio nec enim ornare faucibus et enim id. Maecenas sed justo eu massa adipiscing mauris ultricies at ut. Morbi ultricies vulputate ligula, dignissim eu metus lobortis non. Vivamus volutpat scelerisque scelerisque.",

"Curabitur luctus lectus ut felis condimentum temporary. Proin eu tellus nec lectus condimentum consectetur. Etiam auctor tempor dignissim. Donec consectetuer dolor sit amet velit rhoncus varius. Nulla felis ante, sodales ut bibendum a, sagittis non est. Pellentesque molestie egestas mattis. Mauris sit amet tortor dolor sit amet. Pellentesque habitant morbi tristique senectus et netus et male suada fames ac turpis egestas. Donec tristique facilisis neque eget gravida. Phasellus tempor ligula volutpat eleifend lacus ac.",

"Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Duis nec tellus massa, sit amet congue NISL. Vivamus dapibus varius aliquet. Suspendisse vel metus id eros euismod scelerisque. Vestibulum egestas erat quis Wed vestibulum vestibulum. Integer eget diam elit. In non sapien massa. Curabitur commodo consequat aliquet. Proin ut pretium varius blandit Wed. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Suspendisse vitae mauris eget dolor sit amet vulputate placerat."
];
				var randomnumber = Math.floor(Math.random()*5);

				editor.insertHtml( '<p>' + paragraphs[randomnumber] + '</p>');
			}
		});

		editor.ui.addButton( 'Lorem Ipsum',
		{
			label: 'Insert Lorem Ipsum paragraph',
			command: 'insertLoremIpsum',
			//icon: this.path + 'images/pagebreak.gif',
			text: "Lorem Ipsum"
		} );

	}


} );