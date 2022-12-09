import cors from 'cors';
import express from 'express';
import RoutesRegister from './routes';
import ArtistRegister from './routes/artist';
import ArtistSongRegister from './routes/artist_song';
import LoginRegister from './routes/login';
import RegisterRegister from './routes/register';
import SongRegister from './routes/song';
import SubscriptionRegister from './routes/subscription';

const port = process.env.PORT ?? 8888;
const app = express();

app.use(express.json());
app.use(cors());

// app.use("/route", routeRouter);

RoutesRegister(app);
ArtistRegister(app);
ArtistSongRegister(app);
RegisterRegister(app);
LoginRegister(app);
SongRegister(app);
SubscriptionRegister(app);

app.listen(port, () => {
	console.log(`🌍 Server is running on port ${port}.`);
});
