import { extendTheme } from '@chakra-ui/react';
import Button from './components/button';
import IconButton from './components/icon_button';

export const theme = extendTheme({
	colors: {
		red: '#FF646C',
		green: '#14C679',
		blue: '#0C79F8',
		yellow: '#FFDD3C',
		gold: 'linear-gradient(180deg, #FFC907 0%, #FFE151 35.94%, #FFE04C 46.35%, #FFDC34 63.54%, #FFD300 100%)',
		grey: '#3F4044',
		black: '#1E1F22',
		white: '#fff',
		disabled: 'rgba(138, 140, 143, 0.48)',
		bg: 'linear-gradient(180deg, #000 0%, #1E1F22 70%, #2C2C2C 100%)',
	},
	fonts: {
		heading: 'Poppins, system-ui, sans-serif',
		body: 'Poppins, system-ui, sans-serif',
	},
	styles: {
		global: {
			body: {
				color: 'white',
				bg: 'bg',
			},
		},
	},
	components: {
		Button,
		IconButton,
	},
});
