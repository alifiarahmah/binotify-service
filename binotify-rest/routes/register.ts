import { PrismaClient } from '@prisma/client';
import type express from 'express';
import { type Express } from 'express';
// bcrypt
import bcrypt from 'bcrypt';
import { stringify } from 'querystring';

const prisma = new PrismaClient();

const registerRoute = async (req: express.Request, res: express.Response) => {
	try {
		const { email, username, name, password } = req.body;
		let hashPassword = encryptPassword(password);
		const user = await prisma.user.create({
			data: {
				email,
				username,
				name,
				password: hashPassword
			},
		});
		res.json({
			status: 'success',
		});
	} catch (error: any) {
		res.status(400).json({
			status: 'failed',
			message: error.message,
			data: [],
		});
	}
};

const encryptPassword = function (password: string) {
	return bcrypt.hashSync(password, bcrypt.genSaltSync(12));
};

export default function RegisterRegister(app: Express) {
	app.post('/', registerRoute);
}
