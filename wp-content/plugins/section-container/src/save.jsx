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
import { InnerBlocks, useBlockProps, getColorClassName } from '@wordpress/block-editor';
import Section from './section-tag.jsx';
import classnames from 'classnames';
import { Fragment } from '@wordpress/element';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export default function save({ attributes }) {

	const {
		tagName,
		bgImage,
		bgDesignType,
		bgWidth,
		className
	} = attributes;


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

	const myCustomDesignClass = bgDesignType ? onChangeDesignType(bgDesignType) : undefined;
	const myCustomWidthClass = bgWidth ? bgWidth : undefined;
	const myCustomClassName = className ? className : undefined;
	let myOverlayClass='';
	if(bgImage.overlay!=''){
		myOverlayClass='has-overlay';
	}
	const classes = classnames(
		{
			[myCustomDesignClass]: myCustomDesignClass,
			[myCustomWidthClass]: myCustomWidthClass,
			[myCustomClassName]: myCustomClassName,
			[myOverlayClass]:myOverlayClass,
		}
	);
	const myStyle={
        backgroundImage:"url("+bgImage.url+")",
    };

	return (

		<Section tagName={tagName} className={classes ? classes : undefined}  style={myStyle} >
			<div className="wrapper">
				<InnerBlocks.Content />
			</div>
		</Section>

	);
}
