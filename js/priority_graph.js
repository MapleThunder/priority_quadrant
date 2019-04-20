jQuery(document).ready(function() {

    var graphDiv = document.getElementById('graph');

    var tasks = document.getElementsByClassName('task-row');

    // Define the lines to split the graph up
    var horizontal_line = {
        x: [0, 10],
        y: [5, 5],
        mode: 'lines',
        type: 'scatter',
        name: ''
    };
    var vertical_line = {
        x: [5, 5],
        y: [0, 10],
        mode: 'lines',
        type: 'scatter',
        name: '',
        color: 'grey'
    };

    // Loop through all found task-row elements and pull out the data

    var task_strings = [];
    var task_complexities = [];
    var task_values = [];


    for (var i = 0; i < tasks.length; i++) {
        // Grab the task
        var task = tasks.item(i);
        // Grab the different elements for the different values
        var task_string_elem = task.getElementsByClassName('task-string')[0].valueOf();
        var task_complexity_elem = task.getElementsByClassName('task-complexity')[0].valueOf();
        var task_value_elem = task.getElementsByClassName('task-value')[0].valueOf();

        // Get the values nested in the elements
        var task_string = task_string_elem.getElementsByClassName('field__item')[0].valueOf().innerHTML;
        var task_complexity = task_complexity_elem.getElementsByClassName('field__item')[0].valueOf().innerHTML;
        var task_value = task_value_elem.getElementsByClassName('field__item')[0].valueOf().innerHTML;

        // Append the values to the holder arrays
        task_strings.push(task_string);
        task_complexities.push(task_complexity);
        task_values.push(task_value);
    }

    for (var ac = 0; ac < task_complexities.length; ac++) {
        var c = task_complexities[ac];

        if (!Number.isInteger(parseInt(c))) {
            task_complexities[ac] = convertSizeToNumber(c);
        }
        else {
            task_complexities[ac] = parseInt(c);
        }
    }
    for (var av = 0; av < task_values.length; av++) {
        var v = task_values[av];

        if (!Number.isInteger(parseInt(v))) {
            task_values[av] = convertSizeToNumber(v);
        }
        else {
            task_values[av] = parseInt(v);
        }
    }

    var tasks_markers = {
        x: task_complexities,
        y: task_values,
        mode: 'markers',
        type: 'scatter',
        name: 'Tasks',
        text: task_strings
    };

    var data = [horizontal_line, vertical_line, tasks_markers];

    var layout = {
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