import React from "react";
import {
	LineChart,
	Line,
	XAxis,
	YAxis,
	CartesianGrid,
	Tooltip,
	Legend,
	
} from "recharts";


function ChartWidget({data}) {
	return (
		<div className="chart-widget">
				<LineChart
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
				</LineChart>
			
		</div>
	);
}


export default ChartWidget;
