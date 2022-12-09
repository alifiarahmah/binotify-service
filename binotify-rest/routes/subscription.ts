import Prisma from '@prisma/client';
import type express from 'express';
import { type Express } from 'express';
import { getSubscriberById } from '../lib/getPHP';
import { getSOAP } from '../lib/getSOAP';
import { parseSubscriber } from '../lib/parseSubscriber';
import { ISubscriber } from '../models/ISubscriber';
const { PrismaClient } = Prisma;

const prisma = new PrismaClient();

const subscriptionRoute = async (
	req: express.Request,
	res: express.Response
) => {
	try {
		// FIXME: put this in a middleware
		// const token = req.headers.authorization?.split(' ')[1];
		// if (!token) {
		// 	res.status(401).json({
		// 		status: 'failed',
		// 		message: 'Unauthorized',
		// 		data: [],
		// 	});
		// }
		// const decodedToken = jwt.verify(
		// 	token ?? '',
		// 	process.env.JWT_SECRET ?? 'secret'
		// );
		// if (!decodedToken) {
		// 	res.status(401).json({
		// 		status: 'failed',
		// 		message: 'Unauthorized',
		// 		data: [],
		// 	});
		// }
		// const { isAdmin } = decodedToken as { isAdmin: boolean };
		// if (!isAdmin) {
		// 	res.status(401).json({
		// 		status: 'failed',
		// 		message: 'Unauthorized',
		// 		data: [],
		// 	});
		// }

		// perform SOAP request
		const { body } = await getSOAP(
			'/subscription',
			{},
			`<m:generateSubscription></m:generateSubscription>`
		);

		const soap_response = parseSubscriber(body);
		const response: ISubscriber[] = await Promise.all(
			soap_response.map(async (subscriber: ISubscriber) => {
				// map creator with prisma
				const { creatorId, subscriberId } = subscriber;
				const creator = await prisma.user.findUnique({
					where: {
						user_id: Number(creatorId),
					},
					select: {
						username: true,
						name: true,
					},
				});
				// map subscriber with getPHP
				const subscriberData = await getSubscriberById(Number(subscriberId));
				return {
					...subscriber,
					creatorUsername: creator?.username,
					creatorName: creator?.name,
					subscriberUsername: subscriberData.username,
				};
			})
		);

		const { page, limit } = req.query;
		if (page == 'all') {
			res.json({
				status: 'success',
				data: response,
			});
		} else {
			// paginate response
			const currentPage = Number(page) || 1;
			const currentLimit = Number(limit) || 2;
			const startIndex = (currentPage - 1) * currentLimit;
			const endIndex = currentPage * currentLimit;
			const totalItems = response.length;
			const results = response.slice(startIndex, endIndex);

			res.json({
				status: 'success',
				data: results,
				currentPage,
				currentLimit,
				startIndex,
				totalItems,
				totalPages: Math.ceil(totalItems / currentLimit),
			});
		}
	} catch (error: any) {
		res.status(400).json({
			status: 'failed',
			data: [],
			message: error.message,
		});
	}
};

export default function SubscriptionRegister(app: Express) {
	app.get('/subscriptions', subscriptionRoute);
}
