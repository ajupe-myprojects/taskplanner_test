'use_strict';

class TaskList extends React.Component 
{
    constructor(props)
    {
        super(props)
        this.state = {
            tasks: props.tasks,
            sort_method: '',
            add_name: '',
            add_desc: '',
            add_date: '',
            add_form: new FormData(),
        }

    }


    async handle_submit_form()
    {
        if(this.state.add_name !== '' && this.state.add_desc !== '' && this.state.add_date !== '')
        {
            this.state.add_form.append('t_name', this.state.add_name);
            this.state.add_form.append('t_description', this.state.add_desc);
            this.state.add_form.append('t_done_by', this.state.add_date);
        }

        const response = await fetch('/api/add_task.php', {
            method: 'POST',
            body: this.state.add_form,
        });
        const task_data = await response.json();

        if(task_data !== '')
        {
            $('#task-add').toggleClass('d-none');
            $('#t-name').val('');
            $('#t-description').val('');
            $('#t-done-by').val('');
            this.props.handleStateChange(task_data)
        }

    }

    handle_delete_task(tid)
    {
        $.ajax({
            url: '/api/del_task.php',
            data: {task_id: tid},
            dataType: 'json',
            type: 'POST',
            success: (json) => {
                //console.log(json)
                this.props.handleStateChange(json)

            },
            error: (err) => {
                console.log(err)
            }

        });
    }


    get_list()
    {
        let add_form = e(
            'form',
            {
                className: 'mb-1 pb-1 row border-bottom d-none', 
                id: 'task-add',
                type: 'POST'
            },
            e(
                'div',
                {
                    className: 'col-3'
                },
                e(
                    'input',
                    {
                        className: 'form-control',
                        type: 'text',
                        name: 't-name',
                        id: 't-name',
                        placeholder: 'Task Name',
                        onChange: () => {this.state.add_name = $('#t-name').val()}
                    }
                )
            ),
            e(
                'div',
                {
                    className: 'col-5'
                },
                e(
                    'input',
                    {
                        className: 'form-control',
                        type: 'text',
                        name: 't-description',
                        id: 't-description',
                        placeholder: 'Task description',
                        onChange: () => {this.state.add_desc = $('#t-description').val()}
                    }
                )
            ),
            e(
                'div',
                {
                    className: 'col-3'
                },
                e(
                    'input',
                    {
                        className: 'form-control',
                        type: 'date',
                        name: 't-done-by',
                        id: 't-done-by',
                        onChange: () => {this.state.add_date = $('#t-done-by').val()}
                    }
                )
            ),
            e(
                'div',
                {
                    className: 'col-1'
                },
                e(
                    'button',
                    {
                        className: 'btn btn-sm btn-primary',
                        type: 'submit',
                        onClick: et => {et.preventDefault();this.handle_submit_form()},
                    },
                    'Submit'
                )
            )
            );

        let frame = e(
            'div', 
            {
                key: 'list', 
                className: 'card'
            }, 
            e(
                'div',
                {
                    key: 'card_head', 
                    className: 'card-header'
                },
                e('h3', {className: 'text-center'}, 'Tasks')
            ),
            e(
                'div',
                {
                    className: 'card-body',
                    key: 'card_body',
                    
                },
                e(
                    'div',
                    {
                        className: 'row mb-3',
                        
                    },
                    e(
                        'div',
                        {
                            className: 'col-2'
                        },
                        e(
                            'button',
                            {
                                className: 'btn btn-success',
                                onClick:() => {$('#task-add').toggleClass('d-none')}
                            },
                            'Add Task'
                        ),
                        
                    ),

                ),
                add_form,
                e(
                    'ul',
                    {
                        className: 'list-group',
                        children: this.state.tasks.data.unique.map(tk => e(
                            'li',
                            {
                                className: 'list-group-item',
                                key: tk.t_id
                            }, 
                            e(
                                'div',
                                {
                                    className: 'row'
                                },
                                e('div',{className: 'col-2'},tk.t_name),
                                e('div',{className: 'col-4'},tk.t_description),
                                e('div',{className: 'col-2'},tk.t_done_by),
                                e('div',{className: 'col-2'},tk.t_created),
                                e('div', {className: 'col-1'}, e('button', {className: 'btn btn-sm btn-warning', id: 'act_'+tk.t_id + '_' + tk.t_user_id }, 'Done')),
                                e('div', {className: 'col-1'}, e('button', {className: 'btn btn-sm btn-danger', id: 'del_'+tk.t_id + '_' + tk.t_user_id, onClick: e => {e.preventDefault(); this.handle_delete_task(tk.t_id)} }, 'Remove'))
                            )
                            )),

                        key: 'u_list'
                    }
                )
            )

            );

        return frame;
    }

}