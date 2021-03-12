import './index.css';
import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from 'react-router-dom';

function Home() {
  return (
    <div style={{ padding: 20 }}>
      <h2>Home View</h2>
      <p>在React中使用React Router v6 的指南</p>
    </div>
  );
}
ReactDOM.render(
  <React.StrictMode>
    <Router>
      <button path="/a" element={<Home />} />
    </Router>
  </React.StrictMode >,
  document.getElementById('root')
);
