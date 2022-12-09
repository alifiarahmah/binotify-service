import { defineStyleConfig } from '@chakra-ui/react';

const IconButton = defineStyleConfig({
	baseStyle: {
		fontWeight: 'bold',
		textTransform: 'uppercase',
		borderRadius: 5,
	},
	sizes: {
		sm: {
			fontSize: 'sm',
			px: 4,
			py: 3,
		},
		md: {
			fontSize: 'md',
			px: 6,
			py: 4,
		},
		lg: {
			fontSize: 'lg',
			px: 6,
			py: 6,
		},
	},
	variants: {
		solid: {
			bg: 'white',
			color: 'black',
		},
		outline: {
			border: '1px solid',
			borderColor: 'white',
			color: 'white',
			_hover: {
				bg: 'white',
				color: 'black',
			},
		},
		unstyled: {
			bg: 'transparent',
			color: 'white',
			_hover: {
				bg: 'transparent',
				color: 'yellow',
			},
		},
	},
	defaultProps: {
		size: 'lg',
		variant: 'solid',
	},
});

export default IconButton;
