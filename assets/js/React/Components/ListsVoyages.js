import React from 'react';
import Translator from "bazinga-translator";

class ListsVoyages extends React.Component {
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

    isHighway(highway) {
        if(highway){
            return (
                <span className="blued mt-2"><i className="fas fa-road"></i></span>

            );
        }
        return (<div></div>);

    }
    isArrivalDate(arrivalDate) {
        if(arrivalDate === '.'){
            return (
                <p className="white very-small text-center">{arrivalDate}</p>
            );
        }
        return (<p className="rosed very-small text-center">{arrivalDate}</p>);

    }
    getSeats(seats) {
        if(seats > 0){
            if(seats > 1)
            return (<span className="badge badge-info py-2 ml-2"><h7>{seats} {Translator.trans('Seats available')} </h7></span>);
            else {
                return (<span className="badge badge-info py-2 ml-2"><h7>{seats} {Translator.trans('Seat available')} </h7></span>);
            }
        }
        return (<span className="badge badge-danger"><h7>{Translator.trans('Closed Voyage')} </h7></span>);

    }

    renderResult(items){

        return items.map((result) => {

            const id = result.id;
            const creatorName = result.creatorName;
            const creatorImage = result.creatorImage;
            const creatorPoint = result.creatorPoint;
            const creatorRating = result.creatorRating;
            const highway = result.highway;
            const timeDeparture = result.timeDeparture;
            const timeArrival = result.timeArrival;
            const departure = result.departure;
            const arrival = result.arrival;
            const price = result.price;
            const arrivalDate = result.arrivalDate;
            const departureDate = result.departureDate;
            const seats = result.seats;
            const favorite = result.favorite;


            let url = Routing.generate('voyage_show', {'id': id});

            let favoriteStatus;
            if(favorite === 'false'){
                favoriteStatus =
                    <form method="post" action="" className="js-favorite-add float-right mr-2" data-object={id} data-type="voyage" data-favorite="false">
                        <div className="flexbox">
                            <div className="fav-btn">
                                <span className="fas fa-heart  favme dashicons dashicons-heart "></span>
                            </div>
                        </div>
                    </form>;
            }
            else if(favorite === 'true'){
                favoriteStatus =
                    <form method="post" action="" className="js-favorite-add float-right mr-2" data-object={id} data-type="voyage" data-favorite="true">
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
                <div className="col-xl-3 col-lg-4 col-sm-6 col-12 mb-4" key={Math.random()}>
                    <div id="voyage_index" className="shadow-border full-border">
                        <div className="meetup_index">
                            <a href={url}>
                                <div className="text-center border-bottom back-gray">
                                    <div className="row">
                                        <div className="col-12 one-voyage">
                                            <div className="one-voyage">
                                                <div className="pt-5">
                                                    <h4 className="meetup-text blued d-inline">{departure}</h4>
                                                    <i className="fas fa-arrow-right rosed d-inline mx-4"></i>
                                                    <h4 className="meetup-text blued d-inline">{arrival}</h4>
                                                </div>
                                                <div className="">
                                                    <span className="white mt-3"><span className="blued">{departureDate}</span></span>
                                                </div>
                                                <div className="">
                                                    <span className="white mt-3"><span className="blued">{timeDeparture}</span></span>
                                                </div>
                                                <div>
                                                    {this.isHighway(highway)}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col-12">
                                            <h4 className="float-right pr-2 pb-1 rosed font-weight-bold">
                                                {price} €
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div className="row py-2">
                            <div className="col-10 rating-voyage">
                                {this.getSeats(seats)}
                            </div>
                            <div className="col-2">
                                {favoriteStatus}
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
                    <h1 className="text-center">« {Translator.trans('There is no results')}</h1>
                </div>
            );
        }
    }
}export default ListsVoyages;
