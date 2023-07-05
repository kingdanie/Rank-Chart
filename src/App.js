import React, { useState, useEffect } from "react";
import ChartWidget from "./chart-widget";

// const data = [
// 	{
// 		name: "Page A",
// 		uv: 4000,
// 		pv: 2400,
// 		amt: 2400,
// 	},
// 	{
// 		name: "Page B",
// 		uv: 3000,
// 		pv: 1398,
// 		amt: 2210,
// 	},
// 	{
// 		name: "Page C",
// 		uv: 2000,
// 		pv: 9800,
// 		amt: 2290,
// 	},
// 	{
// 		name: "Page D",
// 		uv: 2780,
// 		pv: 3908,
// 		amt: 2000,
// 	},
// 	{
// 		name: "Page E",
// 		uv: 1890,
// 		pv: 4800,
// 		amt: 2181,
// 	},
// 	{
// 		name: "Page F",
// 		uv: 2390,
// 		pv: 3800,
// 		amt: 2500,
// 	},
// 	{
// 		name: "Page G",
// 		uv: 3490,
// 		pv: 4300,
// 		amt: 2100,
// 	},
// ];

function App() {
	const [data, setData] = useState([]);
	const [chartDuration, setChartDuration] = useState(7);
	const [isLoading, setIsLoading] = useState(true);

	const fetchData = async () => {
		setIsLoading(true);
		try {
			
			const response = await fetch(
				`/rankchart/wp-json/cr-plugin/v1/data?days=${chartDuration}`
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
		<div className="cr-chart-widget">
			<div className="cr-chart-heading">
				<h1>Graph Widget</h1>
				<select name="days" id="days"onChange={handleDurationChange}>
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
