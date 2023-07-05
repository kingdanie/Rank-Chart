import React from "react";
import ChartWidget from "./chart-widget";


function App() {

    return (
		<div className="cr-chart-widget">
			<div className="cr-chart-heading">
				<h1>Graph Widget</h1>
				<select name="days" id="days">
					<option value="7">Last 7 days</option>
					<option value="15">Last 15 days</option>
					<option value="30">Last 30 days</option>
				</select>
			</div>
			<ChartWidget />
		</div>
	);
}


export default App;