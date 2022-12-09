import { defineStyleConfig } from '@chakra-ui/react';

const Button = defineStyleConfig({
	baseStyle: {
		fontWeight: 'bold',
		textTransform: 'uppercase',
		borderRadius: 'full',
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
			bg: 'gold',
			color: 'black',
			_hover: {
				bg: 'yellow',
				color: 'black',
			},
		},
		outline: {
			border: '1px solid',
			borderColor: 'yellow',
			color: 'yellow',
			_hover: {
				bg: 'yellow',
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

export default Button;
