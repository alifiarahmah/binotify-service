import { Box, BoxProps, Text } from '@chakra-ui/react';
import React from 'react';
import { Link } from 'react-router-dom';

function Logo(props: BoxProps) {
	return (
		<Link to="/">
			<Box color="yellow" w="min-content" {...props}>
				<Text fontWeight="bold" fontSize="2.5em">
					binotify
				</Text>
				<Text
					textTransform="uppercase"
					fontSize="sm"
					letterSpacing="0.25em"
					textAlign="center"
					lineHeight={0.25}
				>
					premium
				</Text>
			</Box>
		</Link>
	);
}

export default Logo;
