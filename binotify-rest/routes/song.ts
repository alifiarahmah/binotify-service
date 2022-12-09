import { PrismaClient } from '@prisma/client';
import express, { type Express } from 'express';
import multer from 'multer';

const prisma = new PrismaClient();

const storage = multer.diskStorage({
	destination: function (req, file, cb) {
		cb(null, 'public/');
	},
	filename: function (req, file, cb) {
		cb(null, file.originalname);
	},
});

const upload = multer({ dest: 'public/' });

const songGetRoute = async (req: express.Request, res: express.Response) => {
	// if method is GET
	try {
		const { artist_id } = req.params;
		const songs = await prisma.song.findMany({
			where: {
				penyanyi_id: Number(artist_id),
			},
		});

		res.json({
			status: 'success',
			data: songs,
		});
	} catch (error: any) {
		res.status(400).json({
			status: 'failed',
			data: [],
		});
	}
};

const songPostRoute = async (req: express.Request, res: express.Response) => {
	try {
		const { artist_id } = req.params;
		const { song_title } = req.body;

		if (req.file) {
			const audio_path = req.file.path;
			const songs = await prisma.song.create({
				data: {
					song_title,
					audio_path,
					penyanyi_id: Number(artist_id),
				},
			});
			res.json({
				status: 'success',
				data: songs,
			});
		} else {
			res.json({
				status: 'success',
				data: [],
			});
		}
	} catch (error: any) {
		res.json({
			status: 'failed',
			data: req.body,
			message: error.message,
		});
	}
};

const songPatchRoute = async (req: express.Request, res: express.Response) => {
	try {
		const { song_id } = req.params;
		const { song_title } = req.body;

		// both song_title and audio_path
		if (song_title && req.file) {
			const audio_path = req.file.path;
			const songs = await prisma.song.update({
				where: {
					song_id: Number(song_id),
				},
				data: {
					song_title,
					audio_path,
				},
			});
			res.json({
				status: 'success',
				data: songs,
			});
		}
		// only song_title
		else if (song_title && req.file) {
			const songs = await prisma.song.update({
				where: {
					song_id: Number(song_id),
				},
				data: {
					song_title,
				},
			});
			res.json({
				status: 'success',
				data: songs,
			});
		}
		// only audio_path
		else if (req.file) {
			const audio_path = req.file.path;
			const songs2 = await prisma.song.update({
				where: {
					song_id: Number(song_id),
				},
				data: {
					audio_path,
				},
			});
			res.json({
				status: 'success',
				data: songs2,
			});
		} else {
			res.json({
				status: 'success',
				data: [],
			});
		}
	} catch {
		res.json({
			status: 'failed',
		});
	}
};

const songDeleteRoute = async (req: express.Request, res: express.Response) => {
	try {
		const { artist_id, song_id } = req.params;
		const songs = await prisma.song.delete({
			where: {
				song_id: Number(song_id),
			},
		});
		res.json({
			status: 'success',
		});
	} catch {
		res.json({
			status: 'failed',
		});
	}
};

export default function SongRegister(app: Express) {
	app.get('/song/:artist_id', songGetRoute);
	app.post('/song/:artist_id', upload.single('audio'), songPostRoute);
	app.patch('/song/:song_id', upload.single('audio'), songPatchRoute);
	app.delete('/song/:artist_id/:song_id', songDeleteRoute);
}
