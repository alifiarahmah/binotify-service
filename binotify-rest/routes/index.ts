import type express from 'express';
import { type Express } from 'express';

const indexRoute = (req: express.Request, res: express.Response) => {
	res.json({
		status: 'success',
		message: 'server is running',
	});
};

export default function RoutesRegister(app: Express) {
	app.get('/', indexRoute);
}
