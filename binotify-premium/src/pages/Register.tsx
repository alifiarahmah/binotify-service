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
	Text,
	useColorModeValue,
	useToast,
} from '@chakra-ui/react';
import axios from 'axios';
import React, { useState } from 'react';
import { MdVisibility, MdVisibilityOff } from 'react-icons/md';
import { Link, useNavigate } from 'react-router-dom';
import Layout from '../components/Layout';

export default function SignupCard() {
	const [showPassword, setShowPassword] = useState(false);
	const [email, setEmail] = useState('');
	const [password, setPassword] = useState('');
	const [name, setName] = useState('');
	const [username, setUsername] = useState('');
	const toast = useToast();
	const navigate = useNavigate();

	const formTextStyle = {
		color: 'black',
	};

	const handleRegister = (e) => {
		e.preventDefault();
		axios
			// @ts-ignore
			.post(`${import.meta.env.VITE_API_URL}/`, {
				name: name,
				username: username,
				email: email,
				password: password,
			})
			.then((res) => {
				toast({
					title: 'Account created.',
					description: 'Login with the account',
					status: 'success',
					isClosable: true,
				});
				navigate('/');
			})
			.catch((err) => {
				toast({
					title: 'Register failed',
					description: err.response.data.message,
					status: 'error',
					isClosable: true,
				});
			});
	};

	return (
		<Layout>
			<Stack spacing={8} mx={'auto'} maxW={'lg'} py={12} px={6}>
				<Stack align={'center'}>
					<Heading fontSize={'4xl'} textAlign={'center'}>
						Register
					</Heading>
					<Text fontSize={'lg'} color={'gray'}>
						to enjoy all of our cool features ✌️
					</Text>
				</Stack>
				<Box
					rounded={'lg'}
					bg={useColorModeValue('white', 'gray')}
					boxShadow={'lg'}
					p={8}
				>
					<form onSubmit={handleRegister}>
						<Stack spacing={4}>
							<FormControl id="name" style={formTextStyle} isRequired>
								<FormLabel>Name</FormLabel>
								<Input type="text" onChange={(e) => setName(e.target.value)} />
							</FormControl>
							<FormControl id="username" style={formTextStyle} isRequired>
								<FormLabel>Username</FormLabel>
								<Input
									type="text"
									onChange={(e) => setUsername(e.target.value)}
								/>
							</FormControl>
							<FormControl id="email" style={formTextStyle} isRequired>
								<FormLabel>Email address</FormLabel>
								<Input
									type="email"
									onChange={(e) => setEmail(e.target.value)}
								/>
							</FormControl>
							<FormControl id="password" style={formTextStyle} isRequired>
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
											<Icon as={showPassword ? MdVisibility : MdVisibilityOff} />
										</Button>
									</InputRightElement>
								</InputGroup>
							</FormControl>
							<Stack spacing={10} pt={2}>
								<Button
									loadingText="Submitting"
									size="lg"
									bg={'yellow'}
									color={'black'}
									_hover={{
										bg: 'blue',
									}}
									onClick={handleRegister}
									type="submit"
								>
									Sign up
								</Button>
							</Stack>
							<Stack pt={2}>
								<Text style={formTextStyle} align={'center'}>
									Already a user?{' '}
									<Link to="/login">
										<Text as={'span'} color={'blue'}>
											Login
										</Text>
									</Link>
								</Text>
							</Stack>
						</Stack>
					</form>
				</Box>
			</Stack>
		</Layout>
	);
}
