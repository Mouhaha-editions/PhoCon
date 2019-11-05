import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

class ContestSmallBox extends React.Component {
    state = {
        contest:
            {
                title: 'loading ..',
                description: 'loading too ..',
            }
    };

    render() {
        return (
            <div>
                <h2>{this.state.contest.title}</h2>
                <p>{this.state.contest.description}</p>
            </div>

        );
    }

    componentDidMount() {
        axios.get('/contest-' + this.props.idContest + '.json')
            .then(res => {
                const contest = res.data;
                this.setState({contest});
            });
    }
}

class ListContestSmallBox extends React.Component {
    state = {
        contests: []
    };

    render() {
        return (<div>
            {
                this.state.contests.map(contest =>
                    <ContestSmallBox idContest={contest.id} key={contest.id}/>
                )
            }
        </div>)
    }

    componentDidMount() {
        axios.get('/opened-contests.json')
            .then(res => {
                const contests = res.data;
                this.setState({contests});
            });
    }
}

ReactDOM.render(
    <ListContestSmallBox/>,
    document.getElementById('root')
);
