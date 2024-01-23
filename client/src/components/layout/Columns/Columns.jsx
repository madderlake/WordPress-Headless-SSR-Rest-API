import React from 'react';
//import classNames from 'classnames';
import { Row, Col, Container } from 'reactstrap';
import ContentBlock from '../../utilities/ContentBlock';
import { Section } from '../Section/Section';
import './columns.css';

const Columns = props => {
  const section = props.section;
  const colGroup = props.columns;

  const getCols = Object.entries(colGroup).map((item, index) => {
    const col = item[1][0];
    const desktopWidth = col.width.desktop;
    const tabletWidth = col.width.tablet;
    const phoneWidth = col.width.phone;
    //const colClass = col.class;

    return (
      <Col
        key={`col-${index}`}
        sm={phoneWidth}
        md={tabletWidth}
        lg={desktopWidth}
        className={`column`}
      >
        <ContentBlock content={col.content} />
      </Col>
    );
  });

  return (
    <Section
      className={`column-wrap ${section.section_class}`}
      section={section}
    >
      <Container className={`column-wrap`}>
        <Row>{getCols}</Row>
      </Container>
    </Section>
  );
};

export default Columns;
