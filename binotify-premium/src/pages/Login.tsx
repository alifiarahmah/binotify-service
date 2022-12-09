import {
	Box,
	Button,
	FormControl,
	FormLabel,
	Heading,
	Icon,
	Input,
	InputGroup,
	InputRightElement,
	Stack,
	useColorModeValue,
	useToast,
} from '@chakra-ui/react';
import axios from 'axios';
import React from 'react';
import { MdVisibility, MdVisibilityOff } from 'react-icons/md';
import { useNavigate } from 'react-router-dom';
import Layout from '../components/Layout';

function Login() {
	const [showPassword, setShowPassword] = React.useState(false);
	const [username, setUsername] = React.useState('');
	const [password, setPassword] = React.useState('');
	const toast = useToast();
	const navigate = useNavigate();

	const handleSubmit = (e) => {
		e.preventDefault();
		axios
			// @ts-ignore
			.post(`${import.meta.env.VITE_API_URL}/login`, {
				username: username,
				password: password,
			})
			.then((res) => {
				// use localStorage to save session token
				localStorage.setItem('token', res.data.token);
				toast({
					title: 'Login successful',
					status: 'success',
					isClosable: true,
				});
				if (res.data.isAdmin) {
					navigate('/subscriptions');
				} else {
					navigate('/song');
				}
			})
			.catch((err) => {
				toast({
					title: 'Login failed',
					description: err.toString(),
					status: 'error',
					isClosable: true,
				});
			});
	};

	return (
		<Layout>
			<Stack spacing={8} mx={'auto'} maxW={'lg'} py={12} px={6}>
				<Stack align={'center'}>
					<Heading fontSize={'4xl'}>Sign in to your account</Heading>
				</Stack>
				<Box
					rounded={'lg'}
					bg={useColorModeValue('white', 'gray')}
					boxShadow={'lg'}
					p={8}
				>
					<form onSubmit={handleSubmit}>
						<Stack spacing={4}>
							<FormControl id="email">
								<FormLabel color={'black'}>Username/Email address</FormLabel>
								<Input
									color={'black'}
									onChange={(e) => setUsername(e.target.value)}
								/>
							</FormControl>
							<FormControl id="password" color={'black'} isRequired>
								<FormLabel>Password</FormLabel>
								<InputGroup>
									<Input
										type={showPassword ? 'text' : 'password'}
										onChange={(e) => setPassword(e.target.value)}
									/>
									<InputRightElement h={'full'}>
										<Button
											variant={'ghost'}
											onClick={() =>
												setShowPassword((showPassword) => !showPassword)
											}
										>
											<Icon
												as={showPassword ? MdVisibility : MdVisibilityOff}
											/>
										</Button>
									</InputRightElement>
								</InputGroup>
							</FormControl>
							<Stack spacing={10}>
								<Button
									bg={'yellow'}
									color={'black'}
									_hover={{
										bg: 'blue',
									}}
									type="submit"
									onClick={handleSubmit}
								>
									Sign in
								</Button>
							</Stack>
						</Stack>
					</form>
				</Box>
			</Stack>
		</Layout>
	);
}

export default Login;
