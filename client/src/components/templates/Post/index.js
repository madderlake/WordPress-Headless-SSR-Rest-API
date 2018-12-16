import React, { Component } from 'react';

import ContentBlock from '../../utilities/ContentBlock';

import './index.css';

class Post extends Component {

	render() {

		if (this.props.data) {

			let data = this.props.data;

			return (
				<div className="grid-container">
					<article className={`${this.props.slug} post-template`}>
						<h1>{data.title.rendered}</h1>
						<ContentBlock content={data.content.rendered} />
					</article>
				</div>
			);

		} else {
			return <div></div>
		}
	}
}

export default Post;
