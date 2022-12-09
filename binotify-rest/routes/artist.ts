import Prisma from '@prisma/client';
const { PrismaClient } = Prisma;
import type express from 'express';
import { type Express } from 'express';

const prisma = new PrismaClient();

const artistRoute = async (req: express.Request, res: express.Response) => {
	try {
		const artists = await prisma.user.findMany({
			where: {
				isAdmin: false,
			},
			select: {
				user_id: true,
				name: true,
			},
		});
		res.json({
			status: 'success',
			data: artists,
		});
	} catch (error: any) {
		res.status(400).json({
			status: 'failed',
			data: [],
		});
	}
};

export default function RoutesRegister(app: Express) {
	app.get('/artist', artistRoute);
}
