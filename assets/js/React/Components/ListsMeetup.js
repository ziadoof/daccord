import React from 'react';
import Translator from "bazinga-translator";

class ListsMeetup extends React.Component {
    constructor(props) {
        super();
        this.state = {
            currentPage: 1,
            itemPerPage: 20,
            totalPage :1,
        };
        this.state.totalPage = Math.ceil(props.result.length / this.state.itemPerPage);
        this.handleClick = this.handleClick.bind(this);
    }

    componentDidUpdate(prevProps) {
        let newProps = this.props.result.length;
        let oldProps = prevProps.result.length;
        // reset page if items array has changed
        if (newProps !== oldProps) {
            this.state.totalPage = Math.ceil(newProps / this.state.itemPerPage);
            this.setState({
                currentPage: Number(1)
            });
        }
    }

    handleClick(event) {
        if(event.target.id < 1 || event.target.id >this.state.totalPage || this.state.totalPage ===1){
            return;
        }
       this.setState({
            currentPage: Number(event.target.id)
        });
    }

     isFinish(finish) {
        if(finish){
            return (
                <span className="badge badge-danger float-left mt-2">{Translator.trans('Finish')}</span>
            );
        }
        return (<div></div>);

    }

    renderResult(items){

        return items.map((result) => {

            const id = result.id;
            const title = result.title;
            const type = Translator.trans(result.type);
            const imageMeetup = result.image;
            const city = result.city;
            const isFinish = result.finish;
            const startAt = result.start;
            const finish = this.isFinish(isFinish);
            const favorite = result.favorite;
            const longTitle = title.slice(0, 27) + (title.length > 27 ? "..." : "");



            let url = Routing.generate('meetup_show', {'id': id});

            let favoriteStatus;
            if(favorite === 'false'){
                favoriteStatus =
                    <form method="post" action="" className="js-favorite-add  float-right mr-2 mb-2" data-object={id} data-type="meetup" data-favorite="false">
                        <div className="flexbox">
                            <div className="fav-btn">
                                <span className="fas fa-heart  favme dashicons dashicons-heart "></span>
                            </div>
                        </div>
                    </form>;
            }
            else if(favorite === 'true'){
                favoriteStatus =
                    <form method="post" action="" className="js-favorite-add  float-right mr-2 mb-2" data-object={id} data-type="meetup" data-favorite="true">
                        <div className="flexbox">
                            <div className="fav-btn">
                                <span className="fas fa-heart  favme dashicons dashicons-heart active"></span>
                            </div>
                        </div>
                    </form>;
            }
            else{
                favoriteStatus = <div></div>;
            }

            return (

                <div className="col-md-6 col-lg-4 my-2 meetup_index" key={Math.random()}>
                    <div className="full-border border-right-0">
                        <div className="back-gray">
                            <a href={url} >
                                <div className="row">
                                    <div className="col-12 image_meetup_index text-center">
                                        <div className="">
                                            <img src={imageMeetup} alt="meetup image"/>
                                        </div>
                                    </div>
                                    <div className="col-12">
                                        <div className="px-2 pb-2">
                                            <div className="">
                                                <h6 className="meetup-text rosed mt-1">
                                                    {/*{{ meetup.title|length > 27 ? meetup.title|slice(0, 27) ~ '...' : meetup.title  }}*/}
                                                    {longTitle}
                                                </h6>
                                            </div>
                                            <div className="">
                                                <span className="white mt-3"><span
                                                    className="blued">{Translator.trans('Type :')}  </span> {type}</span>
                                            </div>
                                            <div className="">
                                                <span className="white mt-3"><span className="blued">{Translator.trans('Start at :')}  </span> {startAt}</span>
                                            </div>
                                            <div className="">
                                                <span className="white mt-3"><span
                                                    className="blued">{Translator.trans('City :')}  </span> {city}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div className="row">
                            <div className="col-12">
                                <div className="px-2 py-2">
                                    {finish}
                                    {favoriteStatus}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            )
        });
    }
    render()
    {

        if (this.props.result.length !== 0) {
            this.data = this.props.result;
            const { currentPage, itemPerPage } = this.state;

            // Logic for displaying Items
            const indexOfLastItem = currentPage * itemPerPage;
            const indexOfFirstItem = indexOfLastItem - itemPerPage;
            const currentItems = this.data.slice(indexOfFirstItem, indexOfLastItem);


            // Logic for displaying page numbers
            const pageNumbers = [];
            for (let i = 1; i <= Math.ceil(this.data.length / itemPerPage); i++) {
                pageNumbers.push(i);
            }

            const renderPageNumbers = pageNumbers.map(number => {
                return (
                        <li className={this.state.currentPage === number ? 'active page-item' : 'page-item'}key={number}>
                            <a  id={number} onClick={this.handleClick} className="page-link ">
                                {number}
                            </a>
                        </li>
                );
            });

            return (
                <div >
                    <div className="row" >
                        {this.renderResult(currentItems)}
                    </div>
                    <div className="pagination-search row justify-content-center mt-4">
                        <div className="navigation">
                            <nav>
                                <ul className="pagination justify-content-center">
                                    <li className="page-item">
                                        <a  id={this.state.currentPage-1} onClick={this.handleClick} className="page-link" >
                                            « {Translator.trans('Previous')}
                                        </a>
                                    </li>
                                    {renderPageNumbers}
                                    <li className="page-item">
                                        <a  id={this.state.currentPage+1} onClick={this.handleClick} className="page-link">
                                            {Translator.trans('Next')} »
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            );
        } else {
            return (
                <div key={Math.random()}>
                    <h1 className="text-center">{Translator.trans('There is no results')}</h1>
                </div>
            );
        }
    }
}export default ListsMeetup;
