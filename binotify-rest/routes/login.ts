import { PrismaClient } from '@prisma/client';
import type express from 'express';
import { type Express } from 'express';
// bcrypt
import bcrypt from 'bcrypt';
import { generateAccessToken } from '../lib/generateAccessToken';

const prisma = new PrismaClient();

const loginRoute = async (req: express.Request, res: express.Response) => {
	try {
		const { username, password } = req.body;
		let emailRegex = new RegExp(`^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4}$`);
		let existingUser = emailRegex.test(username)
			? await prisma.user.findUnique({ where: { email: username } })
			: await prisma.user.findUnique({ where: { username: username } });
		let isPasswordSame = existingUser
			? await comparePassword(password, existingUser.password)
			: false;
		if (isPasswordSame && existingUser !== null) {
			const user = {
				user_id: existingUser.user_id,
				username: existingUser.username,
				isAdmin: existingUser.isAdmin,
			};
			const accessToken = generateAccessToken(user);
			res.json({
				status: 'success',
				token: accessToken,
				username: existingUser.username,
				isAdmin: existingUser.isAdmin,
			});
		} else {
			res.status(400).json({
				status: 'failed',
				message: 'Invalid password or username provided',
				data: [],
			});
		}
	} catch (error: any) {
		res.status(400).json({
			status: 'failed',
			message: error.message,
			data: [],
		});
	}
};

const comparePassword = async function (
	password: string,
	hashPassword: string
) {
	return await bcrypt.compare(password, hashPassword);
};

export default function LoginRegister(app: Express) {
	app.post('/login', loginRoute);
}
