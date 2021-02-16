'use_strict';

class TaskList extends React.Component 
{
    constructor(props)
    {
        super(props)
        this.state = {
            tasks: props.tasks,
        }
    }

    get_list()
    {
        let list = this.state.tasks.data.unique.map(tk => {e('p',null, tk.t_description)});

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
                        className: 'btn-group mb-3',
                        role: 'toolbar'
                    },
                    e(
                        'button',
                        {
                            className: 'btn btn-success'
                        },
                        'Add Task'
                    )
                ),
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
                                e('div', {className: 'col-1'}, e('button', {className: 'btn btn-sm btn-warning'}, 'Done')),
                                e('div', {className: 'col-1'}, e('button', {className: 'btn btn-sm btn-danger'}, 'Remove'))
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