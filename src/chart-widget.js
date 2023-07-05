import React from "react";
import {
	LineChart,
	Line,
	XAxis,
	CartesianGrid,
	Tooltip,
	Legend,
	YAxis,
	ResponsiveContainer,
} from "recharts";



function ChartWidget({data}) {
	return (
		<div className="chart-widget">
			{/* <LineChart
				width={500}
				height={300}
				data={data}
				margin={{
					top: 5,
					right: 30,
					left: 20,
					bottom: 5,
				}}
			>
				<CartesianGrid strokeDasharray="3 3" />
				<XAxis dataKey="day" />
				<YAxis />
				<Tooltip />
				<Legend />

				<Line type="monotone" dataKey="setScore" stroke="#82ca9d" />
			</LineChart> */}

			<ResponsiveContainer
				width="100%"
				height="100%"
				minWidth="100%"
				minHeight={300}
			>
				<LineChart
					width={400}
					height={300}
					data={data}
					margin={{
						top: 5,
						right: 10,
						left: 0,
						bottom: 5,
					}}
				>
					<Line type="monotone" dataKey="setScore" stroke="#8884d8" />
					<CartesianGrid strokeDasharray="3 3" />
					<XAxis dataKey="day" />
					<YAxis />
					<Tooltip />
					<Legend />
				</LineChart>
			</ResponsiveContainer>
		</div>
	);
}


export default ChartWidget;
