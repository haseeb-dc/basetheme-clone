/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
import { InspectorControls, InnerBlocks, useBlockProps,MediaUpload } from '@wordpress/block-editor';
import { Panel, PanelBody, PanelRow, RadioControl, ColorPalette,Button,ToggleControl,ColorPicker } from '@wordpress/components';
import classnames from 'classnames';
import Section from './section-tag.jsx';
import Media from './media.jsx';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit(props) {
	const {
		attributes,
		setAttributes,
	} = props;
	const { tagName, bgDesignType, bgWidth, bgImage,className } = attributes;


	const onChangeDesignType = (bgGradient) => {
		let dcgradient = '';

		switch (bgGradient) {
			case '#c81413':
				dcgradient = 'red-ctn';
				break;
			case '#04c3b4':
				dcgradient = 'sea-green-ctn';
				break;
			case '#141414':
				dcgradient = 'black-ctn';
				break;
			default:
				dcgradient = '';
		}
		return dcgradient;
	};

	const myCustomClassName = className ? className : undefined;
	const myCustomWidthClass = bgWidth ? 'content-width-border editor-' + bgWidth : undefined;
	const myCustomDesignClass = bgDesignType ? 'editor-' + onChangeDesignType(bgDesignType) : undefined;
	const classes = classnames(
		{
			[myCustomWidthClass]: myCustomWidthClass,
			[myCustomDesignClass]: myCustomDesignClass,
			[myCustomClassName]: myCustomClassName,
		}
	);
	const blockProps = useBlockProps({
		className: classes
	})
	return (

		<div  {...blockProps}>

			<InspectorControls>
				<Panel>
					<PanelBody title={__('Container Width')} initialOpen={true}>

						<PanelRow>
							<RadioControl
								help={__('Please choose container width.')}
								selected={bgWidth}
								options={[

									{ label: "Width 1260px (Default)", value: "ctn" },
									{ label: "Width 1860px", value: "ctn-1860" },
									{ label: "Width 1060px", value: "ctn-1060" },
								]
								}
								onChange={(value) => setAttributes({
									bgWidth: value,
								})}
							/>
						</PanelRow>
					</PanelBody>
					<PanelBody
						title={__('Background Design')}
						className="dc-design-style"
						initialOpen={true}
					>
						<ColorPalette
							value={bgDesignType}
							clearable={false}
							disableCustomColors={true}
							colors={[
								{ name: 'Container Red', color: '#c81413' },
								{ name: 'Container Sea Green', color: '#04c3b4' },
								{ name: 'Container Black', color: '#141414' },
							]}
							onChange={(color) => setAttributes({
								bgDesignType: color,
							})}
						/>
					</PanelBody>
					<PanelBody
						title={__('Background Image')}
						className="dc-design-image"
						initialOpen={true}
					>
						<PanelRow>
							<Media props={props} />

						</PanelRow>
					</PanelBody>
				</Panel>

			</InspectorControls>
			<Section
				tagName={tagName}
				className={
					classnames(onChangeDesignType(bgDesignType), bgWidth ? bgWidth : undefined)
				}
			>
				<InnerBlocks />
			</Section>
		</div>
	);
}
