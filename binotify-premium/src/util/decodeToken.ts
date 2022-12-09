import jwt_decode from 'jwt-decode';

export function decodeToken(token: string) {
	if (!token) {
		return {
			user_id: null,
			username: null,
			email: null,
		};
	}
	const decoded: {
		user_id: string;
		username: string;
		isAdmin: boolean;
	} = jwt_decode(token);
	return {
		user_id: decoded.user_id,
		username: decoded.username,
		isAdmin: decoded.isAdmin,
	};
}
