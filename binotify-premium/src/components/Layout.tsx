import { Box } from '@chakra-ui/react';
import React from 'react';
import Navbar from './Navbar';

interface LayoutProps {
	children: React.ReactNode;
	bg?: string;
	navbarBg?: string;
}

function Layout({ children, ...props }: LayoutProps) {
	return (
		<Box bg={props.bg}>
			<Navbar
				bg={props.navbarBg}
			/>
			<Box px={10} py={10} minH="90vh">
				{children}
			</Box>
		</Box>
	);
}

export default Layout;
