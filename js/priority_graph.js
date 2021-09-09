jQuery(document).ready(function() {

  const graphDiv = document.getElementById('graph');
  const tasks = document.getElementsByClassName('task-row');

  // Define the lines to split the graph up
  const horizontal_line = {
    x: [0, 10],
    y: [5, 5],
    mode: 'lines',
    type: 'scatter',
    name: ''
  };
  const vertical_line = {
    x: [5, 5],
    y: [0, 10],
    mode: 'lines',
    type: 'scatter',
    name: '',
    color: 'grey'
  };

  // Loop through all found task-row elements and pull out the data
  let task_strings = [];
  let task_complexities = [];
  let task_values = [];


  for (let i = 0; i < tasks.length; i++) {
    // Grab the task
    const task = tasks.item(i);

    // Grab the different elements for the different values
    const task_string_elem = task.getElementsByClassName('task__string')[0].valueOf();
    const task_complexity_elem = task.getElementsByClassName('complexity__string')[0].valueOf();
    const task_value_elem = task.getElementsByClassName('task_value__string')[0].valueOf();

    // Get the values nested in the elements
    const task_string = task_string_elem.getElementsByClassName('field__item')[0].valueOf().innerHTML;
    const task_complexity = task_complexity_elem.getElementsByClassName('field__item')[0].valueOf().innerHTML;
    const task_value = task_value_elem.getElementsByClassName('field__item')[0].valueOf().innerHTML;

    // Append the values to the holder arrays
    task_strings.push(task_string);
    task_complexities.push(task_complexity);
    task_values.push(task_value);
  }

  for (let ac = 0; ac < task_complexities.length; ac++) {
    const c = task_complexities[ac];

    if (!Number.isInteger(parseInt(c))) {
      task_complexities[ac] = convertSizeToNumber(c);
    }
    else {
      task_complexities[ac] = parseInt(c);
    }
  }
  for (let av = 0; av < task_values.length; av++) {
    const v = task_values[av];

    if (!Number.isInteger(parseInt(v))) {
      task_values[av] = convertSizeToNumber(v);
    }
    else {
      task_values[av] = parseInt(v);
    }
  }

  const tasks_markers = {
    x: task_complexities,
    y: task_values,
    mode: 'markers',
    type: 'scatter',
    name: 'Tasks',
    text: task_strings
  };

  const data = [horizontal_line, vertical_line, tasks_markers];

  const layout = {
    xaxis: {
      range: [0, 11],
      title: "Task Complexity"
    },
    yaxis: {
      range: [0, 11],
      title: "Task Value"
    },
    title: 'Priority Quadrants'
  };

  Plotly.newPlot(graphDiv, data, layout);
});


function convertSizeToNumber(size) {
  switch (size) {
    case "Extra Small":
      return 2;
    case "Small":
      return 4;
    case "Medium":
      return 6;
    case "Large":
      return 8;
    case "Extra Large":
      return 10;

    default:
      console.log("Size not recognized !");
      return null;
  }
}
