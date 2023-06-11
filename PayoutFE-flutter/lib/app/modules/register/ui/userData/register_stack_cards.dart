// ignore_for_file: import_of_legacy_library_into_null_safe

import 'package:flutter/material.dart';
import 'package:flutter_slider_indicator/flutter_slider_indicator.dart';
import 'package:flutter_stack_card/flutter_stack_card.dart';

// ignore: must_be_immutable
class StackSingleCard extends StatefulWidget {
  StackSingleCard.builder(
      {this.stackType = StackType.middle,
      this.itemBuilder,
      this.itemCount,
      this.dimension,
      this.stackOffset = const Offset(15, 15),
      this.onSwap,
      this.isSwipeActive = true,
      this.displayIndicator = false,
      this.scrollPhysics = const NeverScrollableScrollPhysics(),
      this.displayIndicatorBuilder});

  final int? itemCount;
  final IndexedWidgetBuilder? itemBuilder;
  final ValueChanged<int>? onSwap;
  final bool displayIndicator;
  final bool isSwipeActive;
  final IdicatorBuilder? displayIndicatorBuilder;
  final StackDimension? dimension;
  final StackType stackType;
  final Offset stackOffset;
  ScrollPhysics scrollPhysics = NeverScrollableScrollPhysics();

  var pageController = PageController();

  void initPage(bool animated) {
    pageController.animateToPage(0,
        duration: Duration(milliseconds: animated ? 1000 : 100),
        curve: Curves.bounceIn);
  }

  @override
  _StackCardsState createState() => _StackCardsState();
}

class _StackCardsState extends State<StackSingleCard> {
  var _currentPage = 0.0;
  var _width, _height;

  @override
  void dispose() {
    super.dispose();
    widget.pageController.dispose();
  }

  @override
  Widget build(BuildContext context) {
    widget.pageController.addListener(() {
      setState(() {
        _currentPage = widget.pageController.page ?? 0;
      });
    });

    if (widget.dimension == null) {
      _height = MediaQuery.of(context).size.height;
      _width = MediaQuery.of(context).size.width;
    } else {
      assert((widget.dimension?.width ?? 0) > 0);
      assert((widget.dimension?.height ?? 0) > 0);
      _width = widget.dimension?.width;
      _height = widget.dimension?.height;
    }

    return Stack(
        fit: StackFit.expand,
        children: (widget.isSwipeActive)
            ? isSwipeActiveWidget()
            : isNotSwipeActiveWidget());
  }

  List<Widget> isSwipeActiveWidget() {
    return [
      _cardStack(),
      PageView.builder(
        onPageChanged: widget.onSwap,
        physics: widget.scrollPhysics,
        controller: widget.pageController,
        itemCount: widget.itemCount,
        itemBuilder: (context, index) {
          return Container();
        },
      ),
      widget.displayIndicator ? _cardIndicator() : Container()
    ];
  }

  List<Widget> isNotSwipeActiveWidget() {
    return [
      PageView.builder(
        onPageChanged: widget.onSwap,
        physics: widget.scrollPhysics,
        controller: widget.pageController,
        itemCount: widget.itemCount,
        itemBuilder: (context, index) {
          return Container();
        },
      ),
      _cardStack(),
      widget.displayIndicator ? _cardIndicator() : Container()
    ];
  }

  Widget _cardStack() {
    List<Widget> _cards = [];

    for (int i = (widget.itemCount ?? 0) - 1; i >= 0; i--) {
      var sizeOffsetx =
          (widget.stackOffset.dx * i) - (_currentPage * widget.stackOffset.dx);
      var sizeOffsety =
          (widget.stackOffset.dy * i) - (_currentPage * widget.stackOffset.dy);
      var leftOffset =
          (widget.stackOffset.dx * i) - (_currentPage * widget.stackOffset.dx);
      var topOffset =
          (widget.stackOffset.dy * i) - (_currentPage * widget.stackOffset.dy);

      _cards.add(Positioned.fill(
        child: _cardbuilder(
            i,
            widget.stackType == StackType.middle
                ? _width - sizeOffsetx
                : _width,
            _height - sizeOffsety),
        top: topOffset,
        left: widget.stackType == StackType.middle
            ? (_currentPage > (i) ? -(_currentPage - i) * (_width * 4) : 0)
            : (_currentPage > (i)
                ? -(_currentPage - i) * (_width * 4)
                : leftOffset),
      ));
    }

    return Stack(fit: StackFit.expand, children: _cards);
  }

  Widget _cardbuilder(int index, double width, double height) {
    double finalWidth = width * .9 < 0 ? 100 : width * .9;
    double finalHeight = height * .8 < 0 ? 100 : height * .8;

    return Align(
        alignment: Alignment.topCenter,
        child: Container(
            width: finalWidth,
            height: finalHeight,
            child: widget.itemBuilder!(context, index)));
  }

  Widget _cardIndicator() {
    return Align(
      alignment: Alignment.bottomCenter,
      child: Padding(
        padding: const EdgeInsets.only(bottom: 24),
        child: SliderIndicator(
          length: widget.itemCount ?? 0,
          activeIndex: _currentPage.round(),
          displayIndicatorIcon:
              widget.displayIndicatorBuilder!.displayIndicatorIcon,
          displayIndicatorActiveIcon:
              widget.displayIndicatorBuilder!.displayIndicatorActiveIcon,
          displayIndicatorColor:
              widget.displayIndicatorBuilder?.displayIndicatorColor ??
                  Colors.white,
          displayIndicatorActiveColor:
              widget.displayIndicatorBuilder?.displayIndicatorActiveColor ??
                  Colors.white,
          displayIndicatorSize:
              widget.displayIndicatorBuilder?.displayIndicatorSize ?? 0,
        ),
      ),
    );
  }
}
