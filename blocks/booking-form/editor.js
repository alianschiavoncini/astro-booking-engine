( function( wp ) {

	var el = wp.element.createElement;
	var __ = wp.i18n.__;
	var registerBlockType = wp.blocks.registerBlockType;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelColorSettings = wp.blockEditor.PanelColorSettings;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var PanelBody = wp.components.PanelBody;
	var TextControl = wp.components.TextControl;
	var ToggleControl = wp.components.ToggleControl;
	var RangeControl = wp.components.RangeControl;
	var Disabled = wp.components.Disabled;
	var ServerSideRender = wp.serverSideRender;

	registerBlockType( 'astro-booking-engine/booking-form', {

		edit: function( props ) {

			var attributes = props.attributes;
			var setAttributes = props.setAttributes;
			var blockProps = useBlockProps();

			var formPanel = el( PanelBody, {
					title: __( 'Form', 'astro-booking-engine' ),
					initialOpen: true
				},
				el( TextControl, {
					label: __( 'Submit button label', 'astro-booking-engine' ),
					help: __( 'Leave empty to use the label from the plugin settings.', 'astro-booking-engine' ),
					value: attributes.submitLabel,
					onChange: function( value ) {
						setAttributes( { submitLabel: value } );
					}
				} )
			);

			var layoutPanel = el( PanelBody, {
					title: __( 'Layout', 'astro-booking-engine' ),
					initialOpen: true
				},
				el( ToggleControl, {
					label: __( 'Customize layout for this block', 'astro-booking-engine' ),
					help: __( 'When off, the block uses the layout defined in the plugin settings.', 'astro-booking-engine' ),
					checked: !! attributes.customizeLayout,
					onChange: function( value ) {
						setAttributes( { customizeLayout: value } );
					}
				} ),
				attributes.customizeLayout && el( RangeControl, {
					label: __( 'Form container border radius (px)', 'astro-booking-engine' ),
					value: attributes.widgetBorderRadius,
					onChange: function( value ) {
						setAttributes( { widgetBorderRadius: value } );
					},
					min: 0,
					max: 50,
					allowReset: true
				} ),
				attributes.customizeLayout && el( RangeControl, {
					label: __( 'Field border radius (px)', 'astro-booking-engine' ),
					value: attributes.fieldBorderRadius,
					onChange: function( value ) {
						setAttributes( { fieldBorderRadius: value } );
					},
					min: 0,
					max: 50,
					allowReset: true
				} ),
				attributes.customizeLayout && el( RangeControl, {
					label: __( 'Submit button border radius (px)', 'astro-booking-engine' ),
					value: attributes.submitBorderRadius,
					onChange: function( value ) {
						setAttributes( { submitBorderRadius: value } );
					},
					min: 0,
					max: 50,
					allowReset: true
				} )
			);

			var colorsPanel = attributes.customizeLayout && el( PanelColorSettings, {
				title: __( 'Form colors', 'astro-booking-engine' ),
				initialOpen: false,
				colorSettings: [
					{
						value: attributes.widgetBackgroundColor,
						enableAlpha: true,
						label: __( 'Form container background color', 'astro-booking-engine' ),
						onChange: function( value ) {
							setAttributes( { widgetBackgroundColor: value || '' } );
						}
					},
					{
						value: attributes.labelFontColor,
						enableAlpha: true,
						label: __( 'Label text color', 'astro-booking-engine' ),
						onChange: function( value ) {
							setAttributes( { labelFontColor: value || '' } );
						}
					},
					{
						value: attributes.fieldFontColor,
						enableAlpha: true,
						label: __( 'Field text color', 'astro-booking-engine' ),
						onChange: function( value ) {
							setAttributes( { fieldFontColor: value || '' } );
						}
					},
					{
						value: attributes.fieldBackgroundColor,
						enableAlpha: true,
						label: __( 'Field background color', 'astro-booking-engine' ),
						onChange: function( value ) {
							setAttributes( { fieldBackgroundColor: value || '' } );
						}
					},
					{
						value: attributes.submitFontColor,
						enableAlpha: true,
						label: __( 'Submit button text color', 'astro-booking-engine' ),
						onChange: function( value ) {
							setAttributes( { submitFontColor: value || '' } );
						}
					},
					{
						value: attributes.submitBackgroundColor,
						enableAlpha: true,
						label: __( 'Submit button background color', 'astro-booking-engine' ),
						onChange: function( value ) {
							setAttributes( { submitBackgroundColor: value || '' } );
						}
					}
				]
			} );

			return el( 'div', blockProps,
				el( InspectorControls, {}, formPanel, layoutPanel, colorsPanel ),
				el( Disabled, {},
					el( ServerSideRender, {
						block: 'astro-booking-engine/booking-form',
						attributes: attributes
					} )
				)
			);

		},

		save: function() {
			return null;
		}

	} );

} )( window.wp );
