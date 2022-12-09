import {
	Button,
	Flex,
	FormControl,
	FormLabel,
	Heading,
	HStack,
	Input,
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
	Th,
	Thead,
	Tr,
	useDisclosure,
	useToast,
} from '@chakra-ui/react';
import axios from 'axios';
import React, { useEffect } from 'react';
import { MdAdd, MdDelete, MdEdit } from 'react-icons/md';
import { useNavigate } from 'react-router-dom';
import Layout from '../components/Layout';
import Pagination from '../components/Pagination';
import { ISong } from '../types';
import { decodeToken } from '../util/decodeToken';

function SongManagement() {
	const {
		isOpen: isOpenDelete,
		onOpen: onOpenDelete,
		onClose: onCloseDelete,
	} = useDisclosure();

	const {
		isOpen: isOpenEdit,
		onOpen: onOpenEdit,
		onClose: onCloseEdit,
	} = useDisclosure();

	const {
		isOpen: isOpenAdd,
		onOpen: onOpenAdd,
		onClose: onCloseAdd,
	} = useDisclosure();

	const [songs, setSongs] = React.useState<ISong[]>([]);
	const [startIndex, setStartIndex] = React.useState(0);
	const [currentPage, setCurrentPage] = React.useState(1);
	const [totalPages, setTotalPages] = React.useState(1);
	const toast = useToast();
	const [title, setTitle] = React.useState('');
	const [selectedSong, setSelectedSong] = React.useState<ISong>();
	const [audio, setAudio] = React.useState<File>();
	const navigate = useNavigate();

	const setFile = (evt) => {
		setAudio(evt.target.files[0]);
	};

	useEffect(() => {
		axios
			// @ts-ignore
			.get(
				`${import.meta.env.VITE_API_URL}/song/${
					decodeToken(localStorage.getItem('token')!).user_id ?? ''
				}`
			)
			.then((res) => {
				setSongs(res.data.data);
				setTotalPages(res.data.totalPages);
			})
			.catch((err) => {
				// if 401, redirect to login
				if (err.response.status === 401) {
					navigate('/login');
				}
			});
	}, []);

	const handleAddSong = async (e) => {
		e.preventDefault();
		const formData = new FormData();
		formData.append('song_title', title);
		formData.append('filename', audio!.name);
		formData.append('audio', audio!);

		axios
			// @ts-ignore
			.post(
				`${import.meta.env.VITE_API_URL}/song/${
					decodeToken(localStorage.getItem('token')!).user_id ?? ''
				}`,
				formData,
				{
					headers: {
						'Content-Type': 'multipart/form-data',
					},
				}
			)
			.then((res) => {
				console.log(res.data);
				toast({
					title: 'Song added.',
					status: 'success',
					isClosable: true,
				});
				onCloseAdd();
			})
			.catch((err) => {
				toast({
					title: 'Add song failed',
					description: err.response.data.message,
					status: 'error',
					isClosable: true,
				});
			});
	};

	const handleEditSong = async (e) => {
		e.preventDefault();

		const formData = new FormData();
		formData.append('song_title', title);
		formData.append('audio', audio!);
		axios
			// @ts-ignore
			.patch(
				`${import.meta.env.VITE_API_URL}/song/${selectedSong?.song_id}`,
				formData,
				{
					headers: {
						'Content-Type': 'multipart/form-data',
					},
				}
			)
			.then((res) => {
				console.log(res.data);
				toast({
					title: 'Song edited.',
					status: 'success',
					isClosable: true,
				});
				onCloseEdit();
			})
			.catch((err) => {
				toast({
					title: 'Edit song failed',
					description: err.response.data.message,
					status: 'error',
					isClosable: true,
				});
			});
	};

	const handleDeleteSong = (e) => {
		e.preventDefault();
		axios
			// @ts-ignore
			.delete(
				`${import.meta.env.VITE_API_URL}/song/${
					decodeToken(localStorage.getItem('token')!).user_id ?? ''
				}/${selectedSong?.song_id}`
			)
			.then((res) => {
				toast({
					title: 'Song deleted.',
					status: 'success',
					isClosable: true,
				});
				onCloseDelete();
			})
			.catch((err) => {
				toast({
					title: 'Delete song failed',
					description: err.response.data.message,
					status: 'error',
					isClosable: true,
				});
			});
	};

	const handleFirstPage = () => {
		setCurrentPage(1);
		axios
			// @ts-ignore
			.get(
				`${import.meta.env.VITE_API_URL}/song/${localStorage.getItem(
					'userId'
				)}?page=1`
			)
			.then((res) => {
				setSongs(res.data.data);
				setStartIndex(res.data.startIndex);
			})
			.catch((err) => {
				// if 401, redirect to login
				if (err.response.status === 401) {
					navigate('/login');
				}
			});
	};

	const handlePrevPage = () => {
		if (currentPage > 1) {
			axios
				// @ts-ignore
				.get(
					`${import.meta.env.VITE_API_URL}/song/${localStorage.getItem(
						'userId'
					)}?page=${currentPage - 1}`
				)
				.then((res) => {
					setSongs(res.data.data);
					setStartIndex(res.data.startIndex);
					setCurrentPage(currentPage - 1);
				})
				.catch((err) => {
					// if 401, redirect to login
					if (err.response.status === 401) {
						navigate('/login');
					}
				});
		}
	};

	const handleNextPage = () => {
		if (currentPage < totalPages) {
			axios
				// @ts-ignore
				.get(
					`${import.meta.env.VITE_API_URL}/song/${localStorage.getItem(
						'userId'
					)}?page=${currentPage + 1}`
				)
				.then((res) => {
					setSongs(res.data.data);
					setStartIndex(res.data.startIndex);
					setCurrentPage(currentPage + 1);
				})
				.catch((err) => {
					// if 401, redirect to login
					if (err.response.status === 401) {
						navigate('/login');
					}
				});
		}
	};

	const handleLastPage = () => {
		setCurrentPage(totalPages);
		axios
			// @ts-ignore
			.get(
				`${import.meta.env.VITE_API_URL}/song/${localStorage.getItem(
					'userId'
				)}?page=${totalPages}`
			)
			.then((res) => {
				setSongs(res.data.data);
				setStartIndex(res.data.startIndex);
				setCurrentPage(totalPages);
			})
			.catch((err) => {
				// if 401, redirect to login
				if (err.response.status === 401) {
					navigate('/login');
				}
			});
	};

	const handleItemClick = (songItem: ISong) => {
		setSelectedSong(songItem);
	};

	return (
		<>
			<Layout>
				<Heading>Song Management</Heading>
				<Table mt={10}>
					<Thead>
						<Tr>
							<Th color="yellow">#</Th>
							<Th color="yellow">Title</Th>
							<Th color="yellow">Action</Th>
						</Tr>
					</Thead>
					<Tbody>
						{songs.map((song, index) => (
							<Tr key={startIndex + index}>
								<Td>{startIndex + index + 1}</Td>
								<Td>{song.song_title}</Td>
								<Td>
									<HStack>
										<Button
											bg="green"
											onClick={() => {
												handleItemClick(song);
												onOpenEdit();
											}}
										>
											<MdEdit />
										</Button>
										<Button
											bg="red"
											onClick={() => {
												handleItemClick(song);
												onOpenDelete();
											}}
										>
											<MdDelete />
										</Button>
									</HStack>
								</Td>
							</Tr>
						))}
					</Tbody>
				</Table>
				<Flex mt={10} justifyContent="flex-end">
					<Button colorScheme="yellow" leftIcon={<MdAdd />} onClick={onOpenAdd}>
						Add Song
					</Button>
				</Flex>
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

			<Modal isOpen={isOpenDelete} onClose={onCloseDelete}>
				<ModalOverlay />
				<ModalContent color={'black'}>
					<ModalHeader>Delete Song</ModalHeader>
					<ModalCloseButton />
					<ModalBody>
						Are you sure you want to delete this song?
					</ModalBody>
					<ModalFooter>
						<Button
							bg="red"
							onClick={handleDeleteSong}
						>
							Delete
						</Button>
						<Button variant={'ghost'} onClick={onCloseDelete}>Cancel</Button>
					</ModalFooter>
				</ModalContent>
			</Modal>

			<Modal isOpen={isOpenEdit} onClose={onCloseEdit}>
				<ModalOverlay />
				<ModalContent color={'black'}>
					<ModalHeader>Edit Song</ModalHeader>
					<ModalCloseButton />
					<ModalBody>
						<FormControl id="title">
							<FormLabel color={'black'}>Title</FormLabel>
							<Input
								type="text"
								placeholder={selectedSong?.song_title}
								onChange={(e) => setTitle(e.target.value)}
							/>
						</FormControl>
						<FormControl id="file">
							<FormLabel color={'black'}>File</FormLabel>
							<Input type="file" accept=".mp3" onChange={setFile} />
						</FormControl>
					</ModalBody>
					<ModalFooter>
						<Button mr={3} onClick={handleEditSong}>
							Confirm
						</Button>
						<Button variant="ghost" onClick={onCloseEdit}>
							Cancel
						</Button>
					</ModalFooter>
				</ModalContent>
			</Modal>

			<Modal isOpen={isOpenAdd} onClose={onCloseAdd}>
				<ModalOverlay />
				<ModalContent color={'black'}>
					<ModalHeader>Add Song</ModalHeader>
					<ModalCloseButton />
					<ModalBody>
						<FormControl id="title" isRequired>
							<FormLabel color={'black'}>Title</FormLabel>
							<Input type="text" onChange={(e) => setTitle(e.target.value)} />
						</FormControl>
						<FormControl id="file" isRequired>
							<FormLabel color={'black'}>File</FormLabel>
							<Input type="file" accept=".mp3" onChange={setFile} isRequired />
						</FormControl>
					</ModalBody>
					<ModalFooter>
						<Button mr={3} onClick={handleAddSong} type="submit">
							Confirm
						</Button>
						<Button variant="ghost" onClick={onCloseAdd}>
							Cancel
						</Button>
					</ModalFooter>
				</ModalContent>
			</Modal>
		</>
	);
}

export default SongManagement;
