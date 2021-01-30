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
                    'ul',
                    {
                        className: 'list-group',
                        children: this.state.tasks.data.unique.map(tk => e(
                            'li',
                            {
                                className: 'list-group-item',
                                key: tk.t_id
                            }, 
                            tk.t_description
                            )),
                        key: 'u_list'
                    }
                )
            )

            );

        return frame;
    }

}