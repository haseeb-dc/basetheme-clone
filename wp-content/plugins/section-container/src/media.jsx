import { __ } from '@wordpress/i18n';
import { MediaUpload } from '@wordpress/block-editor';
import {Button,ToggleControl,ColorPicker } from '@wordpress/components';
export default function Media({ props }) {
	const {
		attributes,
		setAttributes,
	} = props;
	const { bgImage } = attributes;
	return (
		<MediaUpload
			onSelect={(media) => {
			setAttributes({
				bgImage: {
					title: media.title,
					filename: media.filename,
					url: media.url,
				}
				})
				}}
				allowedTypes={ [ 'image' ] }
				multiple={false}
				render={({ open }) => (

				(bgImage.url==='') ? <>
					<Button onClick={ open } className="is-primary">
					{bgImage.url === ''
					? '+ Upload file'
					: 'x Upload new file'}
					</Button>
					</> :  <div className="bgImage-ctn">
					<Button
					onClick={() => {
						setAttributes({
							bgImage: {
								title: '',
								filename:'',
								url:'',
								isOverlay:'',
								overlay:''
							}
						})
					}}
				>
					<img src={bgImage.url} />
				</Button>
				<ToggleControl
					label="Overlay"
					help={__('Check if you want to apply overlay')}
					checked={ bgImage.isOverlay }
					onChange={ () => {
						const isOverlay=!bgImage.isOverlay;
						console.log(bgImage);
						setAttributes({
							bgImage:{
								title: bgImage.title,
								filename: bgImage.filename,
								url: bgImage.url,
								isOverlay:isOverlay
							}
						})
					} }
				/>
				</div>

				)}
		/>
	);
}
