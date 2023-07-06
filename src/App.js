import React, { useState, useEffect } from "react";
import ChartWidget from "./chart-widget";

function App() {
	const [data, setData] = useState([]);
	const [chartDuration, setChartDuration] = useState(7);
	const [isLoading, setIsLoading] = useState(true);

	const fetchData = async () => {
		setIsLoading(true);
		try {
			
			const response = await fetch(
				`/wp-json/cr-plugin/v1/data?days=${chartDuration}`
			);
			const data = await response.json();
			setData(data);
		} catch (error) {
			console.error("Error fetching Data:", error);
		} finally {
			setIsLoading(false);
		}
	}

	const handleDurationChange = (e) => {
		const duration = Number(e.target.value);
		setChartDuration(duration);
	}

	useEffect(() => {
		 fetchData();
	}, [chartDuration]);

	return (
		<div className="rc-chart-widget">
			<div className="rc-heading">
				<h1>Graph Widget</h1>
				<select name="days" id="days" onChange={handleDurationChange}>
					<option value="7">Last 7 days</option>
					<option value="15">Last 15 days</option>
					<option value="30">Last 30 days</option>
				</select>
			</div>
			<div>
				{isLoading ? (
					<div className="rc-loading"> Loading ... </div>
				) : (
					<ChartWidget data={data} />
				)}
			</div>
		</div>
	);
}

export default App;
