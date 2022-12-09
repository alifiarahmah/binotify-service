import { Flex, IconButton, Text } from '@chakra-ui/react';
import React from 'react';
import { MdChevronLeft, MdChevronRight } from 'react-icons/md';
import { TbChevronsLeft, TbChevronsRight } from 'react-icons/tb';

export interface PaginationProps {
	onFirstPage: () => void;
	onPrevPage: () => void;
	onNextPage: () => void;
	onLastPage: () => void;
	currentPage: number;
	totalPages: number;
}

function Pagination({
	onFirstPage,
	onPrevPage,
	onNextPage,
	onLastPage,
	currentPage,
	totalPages,
}: PaginationProps) {
	return (
		<Flex alignItems="center" gap={1}>
			<IconButton
				borderRadius={12}
				borderColor="white"
				variant="outline"
				icon={<TbChevronsLeft size="1.5em" />}
				color="white"
				_hover={{ bg: 'white', color: 'black' }}
				aria-label="first"
				onClick={onFirstPage}
			/>
			<IconButton
				borderRadius={12}
				borderColor="white"
				variant="outline"
				icon={<MdChevronLeft size="1.5em" />}
				color="white"
				_hover={{ bg: 'white', color: 'black' }}
				aria-label="first"
				onClick={onPrevPage}
			/>
			<Text fontSize="lg" mx={5}>
				{currentPage ?? 0} / {totalPages ?? 0}
			</Text>
			<IconButton
				borderRadius={12}
				borderColor="white"
				variant="outline"
				icon={<MdChevronRight size="1.5em" />}
				color="white"
				_hover={{ bg: 'white', color: 'black' }}
				aria-label="first"
				onClick={onNextPage}
			/>
			<IconButton
				borderRadius={12}
				borderColor="white"
				variant="outline"
				icon={<TbChevronsRight size="1.5em" />}
				color="white"
				_hover={{ bg: 'white', color: 'black' }}
				aria-label="first"
				onClick={onLastPage}
			/>
		</Flex>
	);
}

export default Pagination;
