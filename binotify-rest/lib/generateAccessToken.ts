require('dotenv').config();
import jwt from 'jsonwebtoken';
import { ISessionUser } from '../models/ISessionUser';

export function generateAccessToken(username: ISessionUser) {
	return jwt.sign(username, process.env.JWT_SECRET ?? '', {
		expiresIn: '180000000000s',
	});
}
