( function( editor, components, i18n, element, $ ) {
	"use strict";

	const __ = i18n.__;
	const el = element.createElement;
	const compose = wp.compose.compose;
	const registerPlugin = wp.plugins.registerPlugin;

	const {
		Fragment,
		Component 
	} = element;


	const {
		ToggleControl,
		TextareaControl,
		PanelBody
	} = components;

	const {
		dispatch,
		withSelect,
		withDispatch 
	} = wp.data;

	const {
		PluginSidebar,
		PluginSidebarMoreMenuItem 
	} = wp.editPost;

	const Icon = el( 'svg', {
			height: '20px',
			width: '20px',
			viewBox: '0 0 17.39 17.39'
		}, el ( 'polygon', {
			points: '14.77 11.19 17.3 8.65 14.77 6.12 14.77 2.53 11.19 2.53 8.65 0 6.12 2.53 2.53 2.53 2.53 6.12 0 8.65 2.53 11.19 2.53 14.77 6.12 14.77 8.65 17.3 11.19 14.77 14.77 14.77 14.77 11.19'
		} )
	);

	class LoftLoaderProPlugin extends Component {
		constructor() {
			super( ...arguments );

			this.state = this.props.meta;
		}
	
		static getDerivedStateFromProps( nextProps, state ) {
			if ( ( nextProps.isPublishing || nextProps.isSaving ) && ! nextProps.isAutoSaving ) {
				wp.apiRequest( { path: '/loftloaderpro/v2/update-meta?id=' + nextProps.postId, method: 'POST', data: state } ).then(
					( data ) => {
						return data;
					}, ( err ) => {
						return err;
					}
				);
			}
		}
		render() {
			return el( Fragment, {},
				el( PluginSidebarMoreMenuItem, { target: 'loftloader-pro-any-page' }, __( 'LoftLoader Pro Any Page Shortcode' ) ),
				el( PluginSidebar, { name: 'loftloader-pro-any-page', title: __( 'LoftLoader Pro Any Page Shortcode' ) },
					el( PanelBody, { 
							className: 'loftloader-pro-any-page-sidebar',
							// title: __( '' ),
							initialOpen: true
						}, 
						el( ToggleControl, {
							label: i18n.__( 'Display the preloader on the page only once during a visitor session' ),
							checked: this.state.loftloader_pro_show_once,
							onChange: ( value ) => {
								this.setState( { loftloader_pro_show_once: ( value ? 'on' : '' ) } );
							}
						} ),
						el( TextareaControl, {
							label: __( 'Paste LoftLoader shortcode into the box below' ),
							value: this.state.loftloader_pro_page_shortcode,
							onChange: ( value ) => {
								this.setState( { loftloader_pro_page_shortcode: value } );
							}
						} )
					),
					el( 'input', {
						type: 'hidden',
						name: 'loftloader_pro_gutenberg_enabled', 
						value: 'on'
					} )
				)
			);
		}
	}

	// Fetch the post meta.
	const applyWithSelect = withSelect( ( select, { forceIsSaving } ) => { 
		const {
			getEditedPostAttribute,
			getCurrentPostId,
			isSavingPost,
			isPublishingPost,
			isAutosavingPost,
		} = select( 'core/editor' );

		return {
			meta: getEditedPostAttribute( 'meta' ),
			postId: getCurrentPostId(),
			isSaving: forceIsSaving || isSavingPost(),
			isAutoSaving: isAutosavingPost(),
			isPublishing: isPublishingPost(),
		};
	} );

	const render = compose( [
		applyWithSelect
	] )( LoftLoaderProPlugin );

	registerPlugin( 'loftloader-pro-any-page', {
		icon: Icon,
		render
	} );
} )(
	window.wp.editor,
	window.wp.components,
	window.wp.i18n,
	window.wp.element,
	jQuery
);