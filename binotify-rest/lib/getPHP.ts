interface PHPUser {
	user_id: number;
	email: string;
	username: string;
	isAdmin: number;
}

export async function getPHP(url: string){
	const response = await fetch(`${process.env.PHP_BASE_URL}${url}`);
	const data = await response.json();
	return data as PHPUser;
}

export async function getSubscriberById(id: number) {
	return getPHP(`/user/${id}`);
}
