import {
	Button,
	Drawer,
	DrawerBody,
	DrawerContent,
	DrawerHeader,
	DrawerOverlay,
	HStack,
	IconButton,
	Text,
	useDisclosure,
	VStack,
} from '@chakra-ui/react';
import React, { useEffect } from 'react';
import { MdMenu } from 'react-icons/md';
import { Link, useNavigate } from 'react-router-dom';
import { decodeToken } from '../util/decodeToken';
import Logo from './Logo';

interface NavbarProps {
	bg?: string;
}

function Navbar(props: NavbarProps) {
	const { isOpen, onOpen, onClose } = useDisclosure();
	const [isLogged, setIsLogged] = React.useState(
		localStorage.getItem('token') ? true : false
	);
	const [username, setUsername] = React.useState('');
	const [isAdmin, setIsAdmin] = React.useState(false);
	const navigate = useNavigate();

	const handleLogout = () => {
		localStorage.removeItem('token');
		setUsername('');
		setIsAdmin(false);
		setIsLogged(false);
		navigate('/login');
	};

	useEffect(() => {
		if (localStorage.getItem('token') !== null) {
			setIsLogged(true);
			setUsername(decodeToken(localStorage.getItem('token')!).username ?? '');
			setIsAdmin(decodeToken(localStorage.getItem('token')!).isAdmin ?? false);
		}
	}, []);

	return (
		<>
			<HStack
				justifyContent="space-between"
				alignItems="center"
				px={5}
				py={3}
				bg={props.bg}
				h="10vh"
			>
				<HStack>
					<Logo display={{ base: 'none', lg: 'block' }} />
					<Link to="/subscriptions">
						<Button
							mx={3}
							variant="unstyled"
							display={{
								base: 'none',
								lg: isAdmin ? 'flex' : 'none',
							}}
						>
							Subscription Request
						</Button>
					</Link>
					<Link to="/song">
						<Button
							mx={3}
							variant="unstyled"
							display={{
								base: 'none',
								lg: isLogged && !isAdmin ? 'flex' : 'none',
							}}
						>
							Song Management
						</Button>
					</Link>
					<IconButton
						aria-label="Open Drawer"
						icon={<MdMenu size="1.5em" />}
						variant="unstyled"
						size="lg"
						display={{ base: 'block', lg: 'none' }}
						onClick={onOpen}
					/>
				</HStack>
				<HStack gap={5} display={{ base: 'none', lg: 'flex' }}>
					<Text
						fontSize="lg"
						fontWeight="bold"
						textTransform="uppercase"
						display={username.length > 0 ? 'block' : 'none'}
					>
						Hello, {username}!
					</Text>
					{isLogged ? (
						<Button variant="solid" onClick={handleLogout}>
							Log out
						</Button>
					) : (
						<>
							<Button variant="outline" onClick={() => navigate('/login')}>
								Log In
							</Button>
							<Button variant="solid" onClick={() => navigate('/register')}>
								Register
							</Button>
						</>
					)}
				</HStack>
			</HStack>

			<Drawer isOpen={isOpen} placement="left" onClose={onClose}>
				<DrawerOverlay />
				<DrawerContent bg="bg">
					<DrawerHeader display="flex" justifyContent="center">
						<Logo />
					</DrawerHeader>

					<DrawerBody>
						<VStack justifyContent="center" gap={5} mt={5}>
							<Link to="/subscriptions">
								<Button variant="unstyled" display={isAdmin ? 'flex' : 'none'}>
									Subscription Request
								</Button>
							</Link>
							<Link to="/song">
								<Button
									variant="unstyled"
									display={isLogged && !isAdmin ? 'flex' : 'none'}
								>
									Song Management
								</Button>
							</Link>
							{isLogged ? (
								<Button variant="solid" w="full" onClick={handleLogout}>
									Log out
								</Button>
							) : (
								<>
									<Button
										variant="outline"
										w="full"
										onClick={() => navigate('/login')}
									>
										Log In
									</Button>
									<Button
										variant="solid"
										w="full"
										onClick={() => navigate('/register')}
									>
										Register
									</Button>
								</>
							)}
						</VStack>
					</DrawerBody>
				</DrawerContent>
			</Drawer>
		</>
	);
}

export default Navbar;
