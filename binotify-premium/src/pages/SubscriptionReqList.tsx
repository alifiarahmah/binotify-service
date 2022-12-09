import {
	Button,
	Flex,
	Heading,
	HStack,
	Modal,
	ModalBody,
	ModalCloseButton,
	ModalContent,
	ModalFooter,
	ModalHeader,
	ModalOverlay,
	Table,
	Tbody,
	Td,
	Text,
	Th,
	Thead,
	Tr,
	useDisclosure,
} from '@chakra-ui/react';
import axios from 'axios';
import React, { useEffect } from 'react';
import { MdCheck, MdClose } from 'react-icons/md';
import { useNavigate } from 'react-router-dom';
import Layout from '../components/Layout';
import Pagination from '../components/Pagination';
import { ISubscriber } from '../types';



function SubscriptionReqList() {
	const {
		isOpen: isOpenAccept,
		onOpen: onOpenAccept,
		onClose: onCloseAccept,
	} = useDisclosure();
	const {
		isOpen: isOpenReject,
		onOpen: onOpenReject,
		onClose: onCloseReject,
	} = useDisclosure();

	const [subscriptionRequests, setSubscriptionRequests] = React.useState<
		ISubscriber[]
	>([]);
	const [startIndex, setStartIndex] = React.useState(0);
	const [currentPage, setCurrentPage] = React.useState(1);
	const [totalPages, setTotalPages] = React.useState(1);
	const [selectedSubscriber, setSelectedSubscriber] =
		React.useState<ISubscriber>();
	const navigate = useNavigate();

	useEffect(() => {
		axios
			// @ts-ignore
			.get(`${import.meta.env.VITE_API_URL}/subscriptions`)
			.then((res) => {
				setSubscriptionRequests(res.data.data);
				setTotalPages(res.data.totalPages);
			})
			.catch((err) => {
				// if 401, redirect to login
				if (err.response.status === 401) {
					navigate('/login');
				}
			});
	}, []);

	const handleFirstPage = () => {
		setCurrentPage(1);
		axios
			.get(
				// @ts-ignore
				`${import.meta.env.VITE_API_URL}/subscriptions?page=1`
			)
			.then((res) => {
				setSubscriptionRequests(res.data.data);
				setStartIndex(res.data.startIndex);
			})
			.catch((err) => {
				console.log(err);
			});
	};

	const handlePrevPage = () => {
		if (currentPage > 1) {
			axios
				.get(
					// @ts-ignore
					`${import.meta.env.VITE_API_URL}/subscriptions?page=${
						currentPage - 1
					}`
				)
				.then((res) => {
					setSubscriptionRequests(res.data.data);
					setStartIndex(res.data.startIndex);
					setCurrentPage(currentPage - 1);
				})
				.catch((err) => {
					console.log(err);
				});
		}
	};

	const handleNextPage = () => {
		if (currentPage < totalPages) {
			axios
				.get(
					// @ts-ignore
					`${import.meta.env.VITE_API_URL}/subscriptions?page=${
						currentPage + 1
					}`
				)
				.then((res) => {
					setSubscriptionRequests(res.data.data);
					setStartIndex(res.data.startIndex);
					setCurrentPage(currentPage + 1);
				})
				.catch((err) => {
					console.log(err);
				});
		}
	};

	const handleLastPage = () => {
		// @ts-ignore
		axios
			.get(
				// @ts-ignore
				`${import.meta.env.VITE_API_URL}/subscriptions?page=${totalPages}`
			)
			.then((res) => {
				setSubscriptionRequests(res.data.data);
				setStartIndex(res.data.startIndex);
				setCurrentPage(totalPages);
			})
			.catch((err) => {
				console.log(err);
			});
	};

	const handleItemClick = (subscriberItem: ISubscriber) => {
		setSelectedSubscriber(subscriberItem);
	};

	const acceptSubscriptionRequest = (creatorId: any, subscriptionId: any) => {
		axios
			.post(
				`${import.meta.env.VITE_API_URL}/editsubscriptions`,
			JSON.stringify({
				creatorId: `${creatorId}`,
				subscriptionId: `${subscriptionId}`,
				status: "ACCEPTED"
			}))
			.catch((err) => {
				console.log(err);
			});
	

	const rejectSubscriptionRequest = (creatorId: any, subscriptionId: any) => {
		axios
			.post(
				`${import.meta.env.VITE_API_URL}/editsubscriptions`,
			JSON.stringify({
				creatorId: `${creatorId}`,
				subscriptionId: `${subscriptionId}`,
				status: "REJECTED"
			}))
			.catch((err) => {
				console.log(err);
			});
	
	}

	return (
		<>
			<Layout>
				<Heading>Subscription Requests</Heading>
				<Table mt={10}>
					<Thead>
						<Tr>
							<Th color="yellow">#</Th>
							<Th color="yellow">Username</Th>
							<Th color="yellow">Artist</Th>
							<Th color="yellow">Status</Th>
							<Th color="yellow">Action</Th>
						</Tr>
					</Thead>
					<Tbody>
						{subscriptionRequests.map((req, i) => (
							<Tr key={startIndex + i}>
								<Td>{startIndex + i + 1}</Td>
								<Td>{req.subscriberUsername}</Td>
								<Td>{req.creatorUsername}</Td>
								<Td>{req.status}</Td>
								<Td>
									{req.status === 'PENDING' ? (
										<HStack>
											<Button
												bg="green"
												leftIcon={<MdCheck />}
												onClick={() => {
													handleItemClick(req);
													acceptSubscriptionRequest(req.creatorId, req.subscriberId);
													onOpenAccept();
												}}
											>
												Accept
											</Button>
											<Button
												bg="red"
												leftIcon={<MdClose />}
												onClick={() => {
													handleItemClick(req);
													rejectSubscriptionRequest(req.creatorId, req.subscriberId);
													onOpenReject();
												}}
											>
												Reject
											</Button>
										</HStack>
									) : (
										<Text fontSize="lg" py={4}>
											{req.status}
										</Text>
									)}
								</Td>
							</Tr>
						))}
					</Tbody>
				</Table>
				<Flex justifyContent="center" mt={10}>
					<Pagination
						currentPage={currentPage}
						totalPages={totalPages}
						onFirstPage={handleFirstPage}
						onPrevPage={handlePrevPage}
						onNextPage={handleNextPage}
						onLastPage={handleLastPage}
					/>
				</Flex>
			</Layout>

			<Modal isOpen={isOpenAccept} onClose={onCloseAccept} isCentered>
				<ModalOverlay />
				<ModalContent color="black">
					<ModalHeader>Accept Confirmation</ModalHeader>
					<ModalCloseButton />
					<ModalBody>Are you sure you want to accept?</ModalBody>

					<ModalFooter>
						<Button
							mr={3}
							onClick={() => {
								// TODO: handle accept
								console.log('accept', selectedSubscriber);
								onCloseAccept();
							}}
						>
							Confirm
						</Button>
						<Button variant="ghost" onClick={onCloseAccept}>
							Cancel
						</Button>
					</ModalFooter>
				</ModalContent>
			</Modal>

			<Modal isOpen={isOpenReject} onClose={onCloseReject} isCentered>
				<ModalOverlay />
				<ModalContent color="black">
					<ModalHeader>Reject Confirmation</ModalHeader>
					<ModalCloseButton />
					<ModalBody>Are you sure you want to reject?</ModalBody>

					<ModalFooter>
						<Button
							mr={3}
							onClick={() => {
								// TODO: handle rejection
								console.log('reject', selectedSubscriber);
								onCloseReject();
							}}
						>
							Confirm
						</Button>
						<Button variant="ghost" onClick={onCloseReject}>
							Cancel
						</Button>
					</ModalFooter>
				</ModalContent>
			</Modal>
		</>
	);
}}

export default SubscriptionReqList;
