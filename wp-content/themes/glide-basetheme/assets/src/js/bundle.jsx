
requireAll( require.context( './partials/', true, /\.js$/ ) );
requireAll( require.context( './vendor/', true, /\.js$/ ) );

function requireAll( r ) {
	r.keys().forEach( r );
}
