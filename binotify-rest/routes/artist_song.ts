import { PrismaClient } from '@prisma/client';
import type express from 'express';
import { type Express } from 'express';
import { getSOAP } from '../lib/getSOAP';
import { parseSubscriber } from '../lib/parseSubscriber';

const prisma = new PrismaClient();

const artistSongRoute = async (req: express.Request, res: express.Response) => {
	try {
		const { artist_id, user_id } = req.query;
		const songs = await prisma.song.findMany({
			where: {
				penyanyi_id: Number(artist_id),
			},
		});

		const artist = await prisma.user.findUnique({
			where: {
				user_id: Number(artist_id),
			},
			select: {
				user_id: true,
				username: true,
				name: true,
			},
		});

		// connect with SOAP to get subscriber
		const { body } = await getSOAP(
			'/subscription',
			{},
			`<m:generateSubscription></m:generateSubscription>`
		);
		const soap_response = parseSubscriber(body);
		console.log(soap_response);

		// if there is user_id, artist_id, and status ACCEPTED in soap_response, return data
		if (
			soap_response.find(
				(subscriber) =>
					subscriber.creatorId === Number(artist_id) &&
					subscriber.subscriberId === Number(user_id) &&
					subscriber.status === 'ACCEPTED'
			)
		) {
			res.json({
				status: 'success',
				artist,
				data: songs,
			});
		} else {
			res.json({
				status: 'success',
				artist,
				data: [],
			});
		}
	} catch (error: any) {
		res.status(400).json({
			status: 'failed',
			data: [],
		});
	}
};

export default function ArtistSongRegister(app: Express) {
	app.get('/artist_song', artistSongRoute);
}
