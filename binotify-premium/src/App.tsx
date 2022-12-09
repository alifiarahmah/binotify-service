import React from 'react';
import { Route, Routes } from 'react-router-dom';
import NotFound from './pages/404';
import Login from './pages/Login';
import Register from './pages/Register';
import SongManagement from './pages/SongManagement';
import SubscriptionReqList from './pages/SubscriptionReqList';

function App() {
	return (
		<>
			<Routes>
				{/* authentication */}
				{/* add routes here. */}
				<Route path="/" element={<Login />} />
				<Route path="/login" element={<Login />} />
				<Route path="/register" element={<Register />} />

				{/* subscriptions */}
				<Route path="/subscriptions" element={<SubscriptionReqList />} />

				{/* songs */}
				<Route path="/song" element={<SongManagement />} />

				{/* add routes here */}

				{/* misc */}
				<Route path="*" element={<NotFound />} />
			</Routes>
		</>
	);
}

export default App;
